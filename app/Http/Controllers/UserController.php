<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AuthorInterface;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Enums\UserStatusEnum;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Contracts\Interfaces\UserInterface;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateProfileImageRequest;
use App\Http\Requests\UpdateProfilePasswordRequest;

class UserController extends Controller
{
    private UserInterface $users;
    private AuthorInterface $authors;
    private UserService $service;

    public function __construct(UserInterface $users, AuthorInterface $authors, UserService $service)
    {
        $this->users = $users;
        $this->authors = $authors;
        $this->service = $service;
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
    public function update(UpdateProfileRequest $request, User $user)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        $this->authors->updateByUser($user->id, $data['description']);
        $this->users->update($user->id, $data);
        return back()->with('success', 'Berhasil memperbarui profile');
    }

    public function updateImage(UpdateProfileImageRequest $request, User $user)
    {
        $data = $this->service->imageUpdate($request, $user);
        $this->users->update($user->id, $data);
        return back()->with('success', 'Berhasil update photo profile');
    }

    public function updatePassword(UpdateProfilePasswordRequest $request, User $user)
    {
        $data = $request->validated();
        $this->users->update($user->id, $data);
        return back()->with('success', 'Berhasil update password');
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
        return redirect()->back()->with(['success' => 'Siswa Berhasil Dibanned']);
    }
}
