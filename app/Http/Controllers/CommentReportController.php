<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\CommentReportInterface;
use App\Models\CommentReport;
use App\Http\Requests\StoreCommentReportRequest;
use App\Http\Requests\UpdateCommentReportRequest;
use App\Models\Comment;
use App\Services\CommentReportService;
use Illuminate\Http\Request;

class CommentReportController extends Controller
{
    private CommentReportInterface $commentReport;
    private CommentReportService $service;

    public function __construct(CommentReport $commentReport, CommentReportService $service)
    {
        $this->commentReport = $commentReport;
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
    public function store(Request $req, StoreCommentReportRequest $request, Comment $comment)
    {
        $ipAddress = $req->ip();
        $data = $this->service->store($request, $comment, $ipAddress);
        $this->commentReport->store($data);
        return back()->with('success', 'Berhasil laporkan komentar');
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentReport $commentReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommentReport $commentReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentReportRequest $request, CommentReport $commentReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentReport $commentReport)
    {
        $this->commentReport->delete($commentReport->id);
        return back()->with('success','Berhasil menghapus data');   
    }
}
