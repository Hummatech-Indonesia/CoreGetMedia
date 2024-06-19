<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\NewsRejectInterface;
use App\Enums\NewsEnum;
use App\Models\NewsReject;
use App\Http\Requests\StoreNewsRejectRequest;
use App\Http\Requests\UpdateNewsRejectRequest;
use App\Models\News;
use App\Services\NewsRejectService;

class NewsRejectController extends Controller
{
    private NewsRejectInterface $newsReject;
    private NewsInterface $news;
    private NewsRejectService $service;

    public function __construct(NewsRejectInterface $newsReject, NewsInterface $news, NewsRejectService $service)
    {
        $this->newsReject = $newsReject;
        $this->news = $news;
        $this->service = $service;
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
    public function store(StoreNewsRejectRequest $request, News $news)
    {
        $status['status'] = NewsEnum::REJECT->value;
        $this->news->update($news->id, $status);

        $data = $this->service->store($request, $news);
        $this->newsReject->store($data);
        return back()->with('success', 'Berhasil menolak berita ini');
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsReject $newsReject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsReject $newsReject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRejectRequest $request, NewsReject $newsReject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsReject $newsReject)
    {
        
    }
}
