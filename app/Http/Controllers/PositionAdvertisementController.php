<?php

namespace App\Http\Controllers;

use App\Models\PositionAdvertisement;
use App\Http\Requests\StorePositionAdvertisementRequest;
use App\Http\Requests\UpdatePositionAdvertisementRequest;
use App\Contracts\Interfaces\PositionAdvertisementInterface;
use App\Services\AdvertisementService;

class PositionAdvertisementController extends Controller
{
    private PositionAdvertisementInterface $positionAdvertisement;
    private AdvertisementService $service;

    public function __construct(PositionAdvertisementInterface $positionAdvertisement, AdvertisementService $service)
    {
        $this->positionAdvertisement = $positionAdvertisement;
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
    public function store(StorePositionAdvertisementRequest $request)
    {
        $data = $this->service->positionCreate($request);
        $this->positionAdvertisement->store($data);
        return back()->with('success', 'Berhasil menambahkan posisi iklan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PositionAdvertisement $positionAdvertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PositionAdvertisement $positionAdvertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePositionAdvertisementRequest $request, PositionAdvertisement $positionAdvertisement)
    {
        $data = $this->service->positionUpdate($request, $positionAdvertisement);
        $this->positionAdvertisement->update($positionAdvertisement->id, $data);
        return back()->with('success', 'Berhasil update posisi iklan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PositionAdvertisement $positionAdvertisement)
    {
        $this->positionAdvertisement->delete($positionAdvertisement->id);
        return back()->with('success', 'Berhasil menghapus posisi iklan');
    }
}
