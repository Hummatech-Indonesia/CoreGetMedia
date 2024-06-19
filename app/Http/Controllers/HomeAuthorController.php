<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AuthorInterface;
use App\Contracts\Interfaces\FollowerInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Enums\NewsEnum;
use Illuminate\Http\Request;

class HomeAuthorController extends Controller
{
    private AuthorInterface $author;
    private NewsInterface $news;
    private FollowerInterface $follower;

    public function __construct(AuthorInterface $author, NewsInterface $news, FollowerInterface $follower)
    {
        $this->author = $author;
        $this->news = $news;
        $this->follower = $follower;
    }

    public function index()
    {
        $newses = $this->news->whereUser(auth()->user()->id);
        return view('pages.author.profile', compact('newses'));
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

    public function edit(string $id)
    {
        //
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
