<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
use App\Contracts\Interfaces\AdvertismentTransactionInterface;
use App\Contracts\Interfaces\PositionAdvertisementInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Enums\StatusEnum;
use App\Models\Advertisement;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\StoreBiodataAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use App\Models\PositionAdvertisement;
use App\Models\User;
use App\Services\AdvertisementService;
use App\Services\TripayService;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    private AdvertisementInterface $advertisement;
    private PositionAdvertisementInterface $position;
    private AdvertisementService $service;
    private UserInterface $user;

    private AdvertismentTransactionInterface $advertisementPay;
    private TripayService $tripayService;

    public function __construct(AdvertismentTransactionInterface $advertisementPay, TripayService $tripayService, UserInterface $user, AdvertisementInterface $advertisement, PositionAdvertisementInterface $position, AdvertisementService $service)
    {
        $this->advertisement = $advertisement;
        $this->position = $position;
        $this->service = $service;
        $this->user = $user;
        $this->tripayService = $tripayService;
        $this->advertisementPay = $advertisementPay;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_advertisements = $this->advertisement->getall();
        $pending_advertisements = $this->advertisement->where(auth()->user()->id, 'pending');
        $accepted_advertisements = $this->advertisement->where(auth()->user()->id, 'accepted');
        $reject_advertisements = $this->advertisement->where(auth()->user()->id, 'reject');
        $published_advertisements = $this->advertisement->where(auth()->user()->id, 'published');
        $drafts = Advertisement::onlyTrashed()->get();

        return view('pages.user.advertisement.status-advertisement', compact('all_advertisements', 'pending_advertisements', 'accepted_advertisements', 'reject_advertisements', 'published_advertisements', 'drafts'));
    }

    public function list_confirm()
    {
        $data = $this->advertisement->where(null, 'pending');
        return view('pages.admin.advertisement.confirm-advertisement', compact('data'));
    }

    public function list_advertisement()
    {
        $data = $this->advertisement->whereAccepted();
        return view('pages.admin.advertisement.advertisement-list', compact('data'));
    }

    public function detail_admin(Advertisement $advertisement)
    {
        $positions = $this->position->get();
        $data = $this->advertisement->show($advertisement->id);
        return view('pages.admin.advertisement.detail-advertisement', compact('data', 'positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreBiodataAdvertisementRequest $request, User $user)
    {
        $this->user->update(auth()->user()->id, $request->validated());
        $positions = $this->position->get();
        return view('pages.user.advertisement.upload-advertisemenet', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdvertisementRequest $request)
    {
        $data = $this->service->store($request);
        $this->advertisement->store($data);
        return redirect('/status-advertisement-list')->with('success', 'Berhasil mengupload iklan');
    }

    public function draft(StoreAdvertisementRequest $request)
    {
        $data = $this->service->store($request);
        $advertisement = $this->advertisement->store($data);
        $advertisement->delete();
        return redirect('/status-advertisement-list')->with('success', 'Berhasil menyimpan data iklan');
    }

    public function updateDraft(UpdateAdvertisementRequest $request, $id)
    {
        $findDraft = $this->advertisement->withtrash($id);
        $data = $this->service->update($request, $findDraft);
        $data['status'] = StatusEnum::PENDING->value;
        $data['feed'] = StatusEnum::PENDING->value;
        $data['description'] = null;
        $advertisement = $this->advertisement->update($findDraft->id, $data);
        $findDraft->delete();
        return redirect('/status-advertisement-list')->with('success', 'Berhasil menyimpan data iklan');
    }

    public function notDraft($id)
    {
        $findDraft = $this->advertisement->withtrash($id);
        if($findDraft->trashed()){
            $findDraft->restore();
            return redirect('/status-advertisement-list')->with('success', 'Berhasil memulihkan data iklan');
        } else {
            return redirect('/status-advertisement-list')->with('warning', 'Draft tidak di temukan');
        }

    }

    // $advertisements = Advertisement::whereNull('deleted_at')->get();
    // $drafts = Advertisement::onlyTrashed()->get();

    /**
     * Display the specified resource.
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $positions = $this->position->get();
        $data = $this->advertisement->withtrash($id);
        return view('pages.user.advertisement.update-advertisemenet', compact('data', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvertisementRequest $request, $id)
    {
        $findDraft = $this->advertisement->withtrash($id);
        $data = $this->service->update($request, $findDraft);
        $data['status'] = StatusEnum::PENDING->value;
        $data['feed'] = StatusEnum::PENDING->value;
        $data['description'] = null;
        $this->advertisement->update($findDraft->id, $data);
        return redirect('/status-advertisement-list')->with('success', 'Berhasil mengupdate iklan');
    }

    public function published(Advertisement $advertisement)
    {
        $this->advertisement->update($advertisement->id, [
            'status' => StatusEnum::PUBLISHED->value,
            'feed' => StatusEnum::PUBLISHED->value
        ]);
        return redirect('/confirm-advertisement')->with('success', 'Berhasil menerima iklan');
    }

    public function accepted(Advertisement $advertisement)
    {
        $this->advertisement->update($advertisement->id, [
            'status' => StatusEnum::ACCEPTED->value,
            'feed' => StatusEnum::NOTPAID->value,
        ]);
        return redirect('/confirm-advertisement')->with('success', 'Berhasil menerima iklan');
    }

    public function detail_accepted(Advertisement $advertisement)
    {
        $positions = $this->position->get();
        $data = $this->advertisement->show($advertisement->id);
        return view('pages.user.advertisement.detail-payment', compact('data', 'positions'));
    }

    public function rejected(Request $request, Advertisement $advertisement)
    {
        $data = $this->service->reject($request);
        $this->advertisement->update($advertisement->id, $data);
        return redirect('/confirm-advertisement')->with('success', 'Berhasil menolak iklan');
    }

    public function payment_advertisement(Advertisement $advertisement)
    {
        $paymentChannel = $this->tripayService->handlePaymentChannel();
        $positions = $this->position->get();
        $data = $this->advertisement->show($advertisement->id);

        $advertisementPays = $this->advertisementPay->show($advertisement->id);
        if ($advertisementPays != null ) {
            return redirect()->route('detail.transaction', ['advertisement' =>$advertisementPays->advertisement_id ,'reference' => $advertisementPays->reference]);
        } else {
            return view('pages.user.advertisement.detail-advertisement', compact('data', 'positions', 'paymentChannel'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($advertisement)
    {
        $findDraft = $this->advertisement->withtrash($advertisement);
        $findDraft->forceDelete();
        return back()->with('success', 'Berhasil menghapus iklan');
    }

    public function cancel(Advertisement $advertisement)
    {
        $data['status'] = StatusEnum::CANCELED->value;
        $data['feed'] = StatusEnum::CANCELED->value;
        $this->advertisement->update($advertisement->id, $data);
        return redirect('/status-advertisement-list')->with('success', 'Berhasil membatalkan pengiklanan');
    }
}
