<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AuthorInterface;
use App\Contracts\Interfaces\FollowerInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileImageRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Services\UserService;

class ProfileController extends Controller
{
    private UserInterface $user;
    private AuthorInterface $author;
    private UserService $service;
    private FollowerInterface $follower;

    public function __construct(UserInterface $user, AuthorInterface $author, UserService $service, FollowerInterface $follower)
    {
        $this->user = $user;
        $this->author = $author;
        $this->service = $service;
        $this->follower = $follower;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $followings = $this->follower->where('user_id', auth()->user()->id);
        return view('pages.user.profile.index', compact('followings'));
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
    public function store(StoreProfileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
