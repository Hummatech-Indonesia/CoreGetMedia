<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
use App\Contracts\Interfaces\PositionAdvertisementInterface;
use App\Enums\StatusEnum;
use App\Models\Advertisement;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use App\Models\PositionAdvertisement;
use App\Services\AdvertisementService;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    private AdvertisementInterface $advertisement;
    private PositionAdvertisementInterface $position;
    private AdvertisementService $service;

    public function __construct(AdvertisementInterface $advertisement, PositionAdvertisementInterface $position, AdvertisementService $service)
    {
        $this->advertisement = $advertisement;
        $this->position = $position;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_advertisements = $this->advertisement->get();
        $pending_advertisements = $this->advertisement->where(auth()->user()->id, 'pending');
        $accepted_advertisements = $this->advertisement->where(auth()->user()->id, 'accepted');
        $reject_advertisements = $this->advertisement->where(auth()->user()->id, 'reject');
        $published_advertisements = $this->advertisement->where(auth()->user()->id, 'published');

        return view('pages.user.advertisement.status-advertisement', compact('all_advertisements', 'pending_advertisements', 'accepted_advertisements', 'reject_advertisements', 'published_advertisements'));
    }

    public function list_confirm()
    {
        $data = $this->advertisement->where(null, 'pending');
        return view('pages.admin.advertisement.confirm-advertisement', compact('data'));
    }

    public function list_advertisement()
    {
        $data = $this->advertisement->where(null, 'accepted');
        $data2 = $this->advertisement->where(null, 'published');
        return view('pages.admin.advertisement.advertisement-list', compact('data', 'data2'));
    }

    public function detail_admin(Advertisement $advertisement)
    {
        $posisi = $this->position->get();
        $data = $this->advertisement->show($advertisement->id);
        return view('pages.admin.advertisement.detail-advertisement', compact('data', 'posisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posisi = $this->position->get();
        return view('pages.user.advertisement.upload-advertisemenet', compact('posisi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdvertisementRequest $request)
    {
        $data = $this->service->store($request);
        $this->advertisement->store($data);
        return redirect('/')->with('success', 'Berhasil mengupload iklan');
    }

    public function draft(StoreAdvertisementRequest $request)
    {
        $data = $this->service->store($request);
        $advertisement = $this->advertisement->store($data);
        $advertisement->delete();
        return back()->with('success', 'Berhasil menyimpan data iklan');
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
    public function edit(Advertisement $advertisement)
    {
        $posisi = $this->position->get();
        $data = $this->advertisement->show($advertisement->id);
        return view('pages.user.advertisement.update-advertisemenet', compact('data', 'posisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvertisementRequest $request, Advertisement $advertisement)
    {
        $data = $this->service->update($request, $advertisement);
        $data['status'] = StatusEnum::PENDING->value;
        $data['feed'] = StatusEnum::PENDING->value;
        $data['description'] = null;
        $this->advertisement->update($advertisement->id, $data);
        return back()->with('success', 'Berhasil mengupdate iklan');
    }

    public function accepted(Request $request, Advertisement $advertisement)
    {
        $this->advertisement->update($advertisement->id, [
            'status' => StatusEnum::ACCEPTED->value,
            'feed' => StatusEnum::NOTPAID->value
        ]);
        return back()->with('success', 'Berhasil menerima iklan');
    }

    public function rejected(Request $request, Advertisement $advertisement)
    {
        $data = $this->service->reject($request);
        $this->advertisement->update($advertisement->id, $data);
        return back()->with('success', 'Berhasil menolak iklan');
    }

    public function payment_advertisement(Advertisement $advertisement)
    {
        $data = $this->advertisement->show($advertisement->id);
        return view('pages.user.advertisement.detail-advertisement', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $advertisement)
    {
        $this->advertisement->delete($advertisement->id);
        return back()->with('success', 'Berhasil menghapus iklan');
    }

    public function cancel(Advertisement $advertisement)
    {
        $data['status'] = StatusEnum::CANCELED->value;
        $data['feed'] = StatusEnum::CANCELED->value;
        $this->advertisement->update($advertisement->id, $data);
        return back()->with('success', 'Berhasil membatalkan pengiklanan');
    }
}
