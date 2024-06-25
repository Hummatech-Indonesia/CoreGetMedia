<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdminInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminReqeust;
use App\Models\Admin;
use App\Models\User;
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
            $user = $this->admins->store($data);
            $user->assignRole(RoleEnum::ADMIN->value);
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
    public function update(UpdateAdminReqeust $request, User $admin)
    {
        try {
            $data = $this->admin->updateAdmin($request);
            $this->admins->update($admin->id, $data);
            return back()->with('success' , 'Data berhasil di perbarui');
        } catch (\Throwable $th) {
            return back()->with('Error' , 'Data sudah digunakan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        return back()->with('success' , 'Data berhasil di hapus');

        // try {
        //     $this->users->delete($user->id);
        // } catch (\Throwable $th) {
        //     return back()->with('success' , 'Data berhasil dihapus');
        // }
    }
}
