<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdminInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Models\Admin;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private AdminInterface $admins;
    private AdminService $admin;
    private UserInterface $users;

    public function __construct(AdminInterface $admins, UserInterface $users, AdminService $admin)
    {
        $this->admins = $admins;
        $this->admin = $admin;
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = $this->admins->AccountAdmin();
        return view('pages.admin.account.admin', compact('admins'));
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
    public function store(StoreAdminRequest $request)
    {
        try {
            $data = $this->admin->storeOrUpdate($request);
            $this->admins->store($data);
            return redirect()->back()->with('success' , 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('Error' , 'Data sudah digunakan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $data = $this->admin->storeOrUpdate($request);
        $this->admins->update($admin->id, $data);
        return back()->with('success' , 'Data berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
