<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\NewsLikeInterface;
use App\Models\NewsLike;
use App\Http\Requests\UpdateNewsLikeRequest;
use App\Models\News;
use App\Services\NewsLikeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NewsLikeController extends Controller
{
    private NewsLikeInterface $like;
    private NewsInterface $news;
    private NewsLikeService $service;

    public function __construct(NewsLikeInterface $like, NewsLikeService $service, NewsInterface $news)
    {
        $this->like = $like;
        $this->service = $service;
        $this->news = $news;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ip_Address = $request->ip();
        $user_id = auth()->user()->id;
        $newsLike = $this->news->whereUserLike($user_id, $ip_Address, $request);

        return view('pages.user.news-liked.index', compact('newsLike', 'ip_Address', 'user_id'));
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
    public function store(Request $request, News $news)
    {
        $ipAddress = $request->ip();

        $user_id = null;
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        }
        $data['user_id'] = $user_id;

        $data = $this->service->store($user_id, $news->id, $ipAddress);
        $this->like->store($data);

        return response()->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsLike $newsLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsLike $newsLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsLikeRequest $request, NewsLike $newsLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, NewsLike $newsLike, News $news)
    {
        $ipAddress = $request->ip();
        $user_id = null;
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        }
        $this->like->delete($user_id, $ipAddress, $news->id);
        return response()->json();
    }
}
