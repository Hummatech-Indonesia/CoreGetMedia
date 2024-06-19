<?php

namespace App\Services;

use App\Http\Requests\StoreCommentReportRequest;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentReportService
{

    /**
     * Handle store data event to models.
     *
     * @param StoreRequest $request
     *
     * @return array|bool
     */
    public function store(StoreCommentReportRequest $request, $comment, $ipAddress)
    {
        $data = $request->validated();

        $user_id = null;
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        }

        return [
            'user_id' => $user_id,
            'ip_address' => $ipAddress,
            'comment_id' => $comment->id,
            'description' => $data['description'],
        ];
    }
}
