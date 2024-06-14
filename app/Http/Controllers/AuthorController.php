<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AuthorInterface;
use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\PopularInterface;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{
    private AuthorInterface $author;
    private NewsInterface $news;
    private CategoryInterface $category;
    private PopularInterface $popular;
    

    public function __construct(AuthorInterface $author, NewsInterface $news, CategoryInterface $category, PopularInterface $popular)
    {
        $this->author = $author;
        $this->news = $news;
        $this->category = $category;
        $this->popular = $popular;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = $this->author->get();
        return view('pages.admin.author.confirm-author', compact('authors'));
    }

    public function list_author()
    {
        $authors = $this->author->where('accepted');
        return view('pages.admin.author.author-list', compact('authors'));
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
    public function store(StoreAuthorRequest $request)
    {
        $this->author->store($request->validates());
        return back()->with('success', 'Berhasil mendaftarkan diri');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $newses = $this->news->whereUser($author->user_id);
        $popularCategories = $this->category->showWithCount();
        $popularNewses = $this->popular->getpopular();
        return view('pages.user.author.detail-author', compact('author', 'newses', 'popularCategories', 'popularNewses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $this->author->delete($author->id);
        return back()->wihh('success', 'Berhasil menghapus data');
    }

    public function landing()
    {
        $authors = $this->author->accepted();
        return view('pages.user.author.list-author', compact('authors'));
    }
}
