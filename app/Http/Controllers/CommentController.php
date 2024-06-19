<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\CommentInterface;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\News;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private CommentInterface $comment;
    private CommentService $service;

    public function __construct(CommentInterface $comment, CommentService $service)
    {
        $this->comment = $comment;
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
    public function store(Request $req , StoreCommentRequest $request, News $news)
    {
        $ipAddress = $request->ip();
        $data = $this->service->store($request, $news->id, $ipAddress, $req);
        $this->comment->store($data);
        return back()->with('success', 'Berhasil komen');
    }

    public function reply(Request $req, StoreCommentRequest $request, News $news ,$commentId)
    {
        $ipAddress = $request->ip();
        $data = $this->service->store($request, $news->id, $ipAddress, $req);
        $data['parent_id'] = $commentId;
        $this->comment->store($data);
        return back()->with('success', 'Berhasil membalas komentar');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $data['description'] = $request->input('description');
        $this->comment->update($comment->id, $data);
        return back()->with('success', 'Berhasil mengupdate komentar');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->comment->delete($comment->id);
        return back()->with('success', 'Berhasil menghapus komentar');
    }
}
