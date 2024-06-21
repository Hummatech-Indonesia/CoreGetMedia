<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AboutGetInterface;
use App\Models\AboutGet;
use App\Http\Requests\StoreAboutGetRequest;
use App\Http\Requests\UpdateAboutGetRequest;
use App\Services\AdminService;

class AboutGetController extends Controller
{
    private AboutGetInterface $aboutGet;
    private AdminService $service;

    public function __construct(AboutGetInterface $aboutGet, AdminService $service)
    {
        $this->aboutGet = $aboutGet;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.about.index');
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
        $data = $this->service->storeAbout($request);
        $this->aboutGet->store($data);
        return back()->with('success', 'Berhasil membuat about us');
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
        $data = $this->service->updateAbout($request, $aboutGet);
        $this->aboutGet->update($aboutGet->id,$data);
        return back()->with('success', 'Berhasil update about us');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutGet $aboutGet)
    {
        //
    }
}
