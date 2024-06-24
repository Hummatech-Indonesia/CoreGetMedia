<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AuthorInterface;
use App\Contracts\Interfaces\FollowerInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\NewsLikeInterface;
use App\Enums\NewsEnum;
use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;

class HomeAuthorController extends Controller
{
    private AuthorInterface $author;
    private NewsInterface $news;
    private NewsLikeInterface $newsLike;

    private FollowerInterface $follower;

    public function __construct(AuthorInterface $author, NewsInterface $news, NewsLikeInterface $newsLike ,FollowerInterface $follower)
    {
        $this->newsLike = $newsLike;
        $this->author = $author;
        $this->news = $news;
        $this->follower = $follower;
    }

    public function index()
    {
        $newsPending = $this->news->newsStatus(auth()->user()->id, 'pending');
        $newsAccepted = $this->news->newsStatus(auth()->user()->id, 'accepted');
        $newsReject = $this->news->newsStatus(auth()->user()->id, 'reject');
        $newslike = $this->newsLike->count(auth()->user()->id);
        $newses = $this->news->whereUser(auth()->user()->id);
        $author = $this->author->whereUserId();
        $followers = $this->follower->where('author_id', $author->id);
        $followings = $this->follower->where('user_id', auth()->user()->id);
        return view('pages.author.profile', compact('newses', 'newslike', 'newsPending', 'newsAccepted', 'newsReject', 'author', 'followers', 'followings'));
    }

    public function create()
    {
        //  
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Author $author)
    {
        return view('pages.user.profile.update', compact('author'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
