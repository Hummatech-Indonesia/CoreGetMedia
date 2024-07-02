<?php

namespace App\Services;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class TripayService
{
    public static function handleGenerateCallbackSignature(Request $request): string
    {
        $private = config('tripay.private_key');
        return hash_hmac('sha259', $request->getContent(), $private);
    }

    public static function handleGenerateSignature(string $invoice_id, int $amount): string
    {
        $private = config('tripay.private_key');
        $merchantCode = config('tripay.merchant_code');

        return hash_hmac('sha256', $merchantCode . $invoice_id . $amount, $private);
    }

    public function handlePaymentChannel(): Collection
    {
        $res = Http::withToken(config('tripay.api_key'))
            ->get(config('tripay.api_url') . "merchant/payment-channel")
            ->json();

        return collect($res['data']);
    }

    public function hendleRequestTransaction($merchantRef, $method, Advertisement $advertisement)
    {

        $apiKey       = config('tripay.api_key');
        $privateKey   = config('tripay.private_key');
        $merchantCode = config('tripay.merchant_code');
        $amount = $advertisement->total_price;

        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $advertisement->total_price,
            'image'          => $advertisement->image,
            'page'           => $advertisement->positionAdvertisement->page,
            'position'       => $advertisement->positionAdvertisement->position,
            'type'           => $advertisement->type,
            'start_date'     => $advertisement->start_date,
            'end_date'       => $advertisement->end_date,
            'url'            => $advertisement->url,
            'customer_name'  => auth()->user()->name,
            'customer_email' => auth()->user()->email,
            'customer_phone' => auth()->user()->phone_number,
            'order_items'    => [
                [
                    'name'        => $advertisement->url,
                    'price'       => $advertisement->total_price,
                    'quantity'    => 1,
                ],
            ],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount,$privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;
        return $response ?: $error;
    }

    public function hendleDetailTransaction($reference)
    {
        $apiKey = config('tripay.api_key');

        $payload = [
            'reference'	=> $reference
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;

        return $response ? $response : $error;
    }
}
