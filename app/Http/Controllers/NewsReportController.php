<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\NewsReportInterface;
use App\Models\NewsReport;
use App\Http\Requests\StoreNewsReportRequest;
use App\Http\Requests\UpdateNewsReportRequest;
use App\Models\News;
use App\Services\NewsReportService;
use Illuminate\Http\Request;

class NewsReportController extends Controller
{
    private NewsReportInterface $newsReport;
    private NewsReportService $service;

    public function __construct(NewsReportInterface $newsReport, NewsReportService $service)
    {
        $this->newsReport = $newsReport;
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
    public function store(Request $req, StoreNewsReportRequest $request, News $news)
    {
        $ip = $req->ip();
        $data = $this->service->store($request, $news, $ip);
        $this->newsReport->store($data);
        return back()->with('success', 'Berhasil laporkan berita');
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsReport $newsReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsReport $newsReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsReportRequest $request, NewsReport $newsReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsReport $newsReport)
    {
        $this->newsReport->delete($newsReport->id);
        return back()->with('success', 'Berhasil hapus data');
    }
}
