<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\VoucherInterface;
use App\Models\Voucherr;
use App\Http\Requests\StoreVoucherrRequest;
use App\Http\Requests\UpdateVoucherrRequest;

class VoucherrController extends Controller
{
    private VoucherInterface $voucher;
    
    public function __construct(VoucherInterface $voucher)
    {
        $this->voucher = $voucher;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = $this->voucher->paginate();
        return view('pages.admin.voucher.index' , compact('vouchers'));
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
    public function store(StoreVoucherrRequest $request)
    {
        $this->voucher->store($request->validated());
        return redirect()->back()->with('success' , 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucherr $voucherr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucherr $voucherr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherrRequest $request, Voucherr $voucherr)
    {
        $this->voucher->update($voucherr->id, $request->validated());
        return redirect()->back()->with('success' , 'Data berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucherr $voucherr)
    {
        $this->voucher->delete($voucherr->id);
        return redirect()->back()->with('success' , 'Data berhasil di hapus');
    }
}
