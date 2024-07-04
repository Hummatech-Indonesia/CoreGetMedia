<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
use App\Contracts\Interfaces\TransactionsInterface;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CallbackController extends Controller
{
    protected $privateKey;
    private TransactionsInterface $transaction;
    private AdvertisementInterface $advertisement;

    public function __construct(TransactionsInterface $transaction, AdvertisementInterface $advertisement)
    {
        $this->privateKey = config('tripay.private_key');
        $this->transaction = $transaction;
        $this->advertisement = $advertisement;
    }

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);

        if ($data->is_closed_payment === 1) {
            $advertisement = $this->transaction->first($tripayReference);

            if (! $advertisement) {
                return Response::json([
                    'success' => false,
                    'message' => 'No invoice found or already paid: ' . $tripayReference,
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $advertisement->update(['status' => StatusEnum::PAID->value]);
                    $this->advertisement->update($advertisement->advertisement_id, ['status' => StatusEnum::PAID->value]);
                    break;

                case 'EXPIRED':
                    $advertisement->update(['status' => StatusEnum::NOTPAID->value]);
                    break;

                case 'FAILED':
                    $advertisement->update(['status' => 'FAILED']);
                    break;

                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            return Response::json(['success' => true]);
        }
    }
}
