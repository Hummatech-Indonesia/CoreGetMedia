<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
use App\Models\Advertisement;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use App\Services\AdvertisementService;

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
        //
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
        $this->advertisement->store($data);
        return back()->with('success', 'Berhasil mengupload iklan');
    }

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
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $advertisement)
    {
        $this->advertisement->delete($advertisement->id);
        return back()->with('success', 'Berhasil menghapus iklan');
    }
}
