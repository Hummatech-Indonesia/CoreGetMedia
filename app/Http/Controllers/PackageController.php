<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\PackageFeaturesInterface;
use App\Contracts\Interfaces\PackageInteface;
use App\Models\Package;
use App\Http\Requests\StorePackageRequest;
use App\Services\PackageService;

class PackageController extends Controller
{
    private PackageInteface $package;
    private PackageFeaturesInterface $packageFeatures;
    private PackageService $service;

    public function __construct(PackageInteface $package, PackageService $service, PackageFeaturesInterface $packageFeatures)
    {
        $this->package = $package;
        $this->packageFeatures = $packageFeatures;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = $this->package->get();
        return view('', compact('packages'));
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
    public function store(StorePackageRequest $request)
    {
        $data = $this->service->store($request);
        $package_id = $this->package->store($data)->id;

        $this->service->storeFeatures($data['name_feature'], $package_id);
        return back()->with('success', 'Berhasil menambahkan paket berlangganan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePackageRequest $request, Package $package)
    {
        $data = $this->service->store($request);
        $package_id = $this->package->update($package->id, $data)->id;

        $this->service->storeFeatures($data['name_features'], $package_id);
        return back()->with('success', 'Berhasil mengupdate paket berlangganan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $this->package->delete($package->id);
        return back()->with('success', 'Berhasil menghapus paket berlangganan.');
    }
}
