<?php

namespace App\Http\Controllers;

use App\Models\NewsTag;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewsTagRequest;
use App\Http\Requests\UpdateNewsTagRequest;
use App\Contracts\Interfaces\NewsTagInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\TagInterface;
use App\Contracts\Interfaces\CategoryInterface;

class NewsTagController extends Controller
{
    private NewsInterface $news;
    private TagInterface $tag;
    private NewsTagInterface $tags;
    private CategoryInterface $category;

    public function __construct(NewsInterface $news, TagInterface $tag, NewsTagInterface $tags, CategoryInterface $category)
    {
        $this->news = $news;
        $this->tag = $tag;
        $this->tags = $tags;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $slug)
    {
        $news = $this->tag->showWithSLug($slug);

        $query = $request->input('search');
        $news_tags = $this->news->whereTag($news->id, 'top');
        $newsTags = $this->news->tagLatest($news->id, 5);

        $CategoryPopulars = $this->category->showWithCount();
        $trendings = $this->news->newsPopular();
        $popularTags = $this->tag->showWithCount();

        return view('pages.user.tag.index', compact('news_tags', 'news', 'newsTags', 'CategoryPopulars', 'trendings', 'popularTags'));
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
    public function store(StoreNewsTagRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsTag $newsTag)
    {
        //
    }

        /**
     * Display the specified resource.
     */
    public function showAll(Request $request, $slug)
    {
        $news = $this->tag->showWithSLug($slug);

        $query = $request->input('search');
        $newsTags = $this->news->taglatest($news->id, 10);
        $CategoryPopulars = $this->category->showWithCount();
        $query = $request->input('search');
        $trendings = $this->news->whereCategory($news->id, $query);
        $popularTags = $this->tag->showWithCount();

        return view('pages.user.tag.all-tag', compact('news', 'newsTags', 'CategoryPopulars', 'trendings', 'popularTags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsTag $newsTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsTagRequest $request, NewsTag $newsTag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsTag $newsTag)
    {
        //
    }
}
