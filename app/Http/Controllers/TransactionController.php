<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
use App\Contracts\Interfaces\PositionAdvertisementInterface;
use App\Http\Requests\TripayRequest;
use App\Models\Advertisement;
use App\Models\PositionAdvertisement;
use App\Services\TripayService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private TripayService $tripayService;
    private AdvertisementInterface $advertisement;
    private PositionAdvertisementInterface $position;

    public function __construct(TripayService $tripayService, AdvertisementInterface $advertisement, PositionAdvertisementInterface $position)
    {
        $this->tripayService = $tripayService;
        $this->advertisement = $advertisement;
        $this->position = $position;
    }

    public function store_advertisement(TripayRequest $request, Advertisement $advertisement)
    {
        $requests =  $request->validated();
        $merchantRef = 'GET' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $transaction = $this->tripayService->hendleRequestTransaction($merchantRef, $requests['payment_code'] , $advertisement);

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
