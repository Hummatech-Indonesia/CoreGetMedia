<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contracts\Interfaces\UserInterface;
use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserInterface $users;

    public function __construct(UserInterface $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->users->AccountUser();
        return view('pages.admin.account.user', compact('users'));
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function banned(User $user)
    {
        $this->users->update($user->id , ['status' => UserStatusEnum::BANNED->value]);
        return redirect()->back()->with(['success' => 'User Berhasil Dibanned']);
    }
}
