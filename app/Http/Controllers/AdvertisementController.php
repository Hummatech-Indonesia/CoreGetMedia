<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
use App\Enums\StatusEnum;
use App\Models\Advertisement;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use App\Services\AdvertisementService;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    private AdvertisementInterface $advertisement;
    private AdvertisementService $service;

    public function __construct(AdvertisementInterface $advertisement, AdvertisementService $service)
    {
        $this->advertisement = $advertisement;
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

    public function detail_admin(Advertisement $advertisement)
    {
        $data = $this->advertisement->show($advertisement->id);
        return view('pages.admin.advertisement.detail-advertisement', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdvertisementRequest $request)
    {
        $data = $this->service->store($request);
        $advertisement = $this->advertisement->store($data);
        // $advertisement->delete();
        // $advertisement->restore();
        return back()->with('success', 'Berhasil mengupload iklan');
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
        $data = $this->advertisement->show($advertisement->id);
        return view('pages.user.advertisement.update-advertisemenet', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvertisementRequest $request, Advertisement $advertisement)
    {
        $data = $this->service->update($request, $advertisement);
        $this->advertisement->update($advertisement->id, $data);
        return back()->with('success', 'Berhasil mengupdate iklan');
    }

    public function accepted(Request $request, Advertisement $advertisement)
    {
        $this->advertisement->update($advertisement->id, [
            'status' => StatusEnum::ACCEPTED->value,
            'feed' => StatusEnum::NOTPAID->value,
            'price' => $request->input('prize')
        ]);
        return back()->with('success', 'Berhasil menerima iklan');
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
