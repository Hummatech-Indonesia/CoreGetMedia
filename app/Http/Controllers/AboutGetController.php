<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AboutGetInterface;
use App\Models\AboutGet;
use App\Http\Requests\StoreAboutGetRequest;
use App\Http\Requests\UpdateAboutGetRequest;

class AboutGetController extends Controller
{
    private AboutGetInterface $aboutGet;

    public function __construct(AboutGetInterface $aboutGet)
    {
        $this->aboutGet = $aboutGet;
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
    public function store(StoreAboutGetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutGet $aboutGet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutGet $aboutGet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutGetRequest $request, AboutGet $aboutGet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutGet $aboutGet)
    {
        //
    }
}
