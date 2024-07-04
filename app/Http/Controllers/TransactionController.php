<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
use App\Contracts\Interfaces\AdvertismentTransactionInterface;
use App\Contracts\Interfaces\PositionAdvertisementInterface;
use App\Contracts\Interfaces\VoucherInterface;
use App\Contracts\Interfaces\VoucherUsedInterface;
use App\Enums\StatusEnum;
use App\Http\Requests\TripayRequest;
use App\Models\Advertisement;
use App\Services\TripayService;

class TransactionController extends Controller
{
    private TripayService $tripayService;
    private AdvertisementInterface $advertisement;
    private AdvertismentTransactionInterface $transactions;
    private PositionAdvertisementInterface $position;
    private VoucherInterface $voucher;
    private VoucherUsedInterface $voucherUsed;

    public function __construct(VoucherInterface $voucher, VoucherUsedInterface $voucherUsed, TripayService $tripayService, AdvertismentTransactionInterface $transactions, AdvertisementInterface $advertisement, PositionAdvertisementInterface $position)
    {
        $this->tripayService = $tripayService;
        $this->advertisement = $advertisement;
        $this->position = $position;
        $this->transactions = $transactions;
        $this->voucher = $voucher;
        $this->voucherUsed = $voucherUsed;
    }

    public function store_advertisement(TripayRequest $request, Advertisement $advertisement)
    {
        $requests =  $request->validated();
        $amount = $advertisement->total_price;
        $firstAmount = "";
        if ($request['voucher_code'] != null) {
            $voucher = $this->voucher->first($request['voucher_code']);
            $discount = ($amount * $voucher->presentation) / 100;
            $firstAmount = $amount - $discount;

            $this->voucherUsed->store([
                'advertisement_id' => $advertisement->id,
                'user_id' => auth()->user()->id,
                'voucher_id' => $voucher->id
            ]);
        } else {
            $firstAmount = $amount;
        }

        $amount11 = ( $firstAmount * 11) / 100;
        $finalAmount = $firstAmount + $amount11;

        $merchantRef = 'GET' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $transaction = $this->tripayService->hendleRequestTransaction($merchantRef, $requests['payment_code'] , $advertisement->url, $finalAmount);

        $this->transactions->store([
            'reference' => $transaction->reference,
            'merchant_ref' => $transaction->merchant_ref,
            'payment_method' => $transaction->payment_method,
            'payment_name' => $transaction->payment_name,
            'user_id' => auth()->user()->id,
            'advertisement_id' => $advertisement->id,
            'callback_url' => $transaction->callback_url,
            'pay_code' => $transaction->pay_code,
            'total_amount' => $finalAmount,
            'total_fee' => $transaction->total_fee,
            'status' => StatusEnum::NOTPAID->value,
        ]);

        return redirect()->route('detail.transaction', ['advertisement' =>$advertisement->id ,'reference' => $transaction->reference]);
    }

    public function show(Advertisement $advertisement, $reference)
    {
        $transaction = $this->tripayService->hendleDetailTransaction($reference);
        $data = $this->advertisement->show($advertisement->id);
        $positions = $this->position->get();
        return view('pages.user.advertisement.detail-payment', compact('data', 'positions', 'transaction'));
    }
}
