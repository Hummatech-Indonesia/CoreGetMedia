<?php

namespace App\Http\Controllers;

use App\Models\PositionAdvertisement;
use App\Http\Requests\StorePositionAdvertisementRequest;
use App\Http\Requests\UpdatePositionAdvertisementRequest;
use App\Contracts\Interfaces\PositionAdvertisementInterface;

class PositionAdvertisementController extends Controller
{
    private PositionAdvertisementInterface $positionAdvertisement;

    public function __construct(PositionAdvertisementInterface $positionAdvertisement)
    {
        $this->positionAdvertisement = $positionAdvertisement;
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
        //
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
    public function update(UpdatePositionAdvertisementRequest $request, PositionAdvertisement $positionAdvertisement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PositionAdvertisement $positionAdvertisement)
    {
        //
    }
}
