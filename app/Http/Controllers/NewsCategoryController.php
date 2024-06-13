<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\NewsCategoryInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\SubCategoryInterface;
use App\Models\NewsCategory;
use App\Http\Requests\StoreNewsCategoryRequest;
use App\Http\Requests\UpdateNewsCategoryRequest;

class NewsCategoryController extends Controller
{
    private NewsCategoryInterface $newsCategory;
    private NewsInterface $news;
    private CategoryInterface $category;
    private SubCategoryInterface $subCategories;

    public function __construct(NewsCategoryInterface $newsCategory, NewsInterface $news, CategoryInterface $category, SubCategoryInterface $subCategories)
    {
        $this->newsCategory = $newsCategory;
        $this->category = $category;
        $this->subCategories = $subCategories;
        $this->news = $news;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,$slug)
    {
        $category = $this->category->showWithSLug($slug);
        $category_id = $category->id;

        $categories = $this->category->get();
        $subCategories = $this->subCategories->get();

        $query = $request->input('search');
        $trendings = $this->news->whereCategory($category_id, $query, 10);
        $newsTop = $this->news->whereCategory($category_id, 'top');
        // $news = $this->news->whereCategory($category_id, 'notop');
        $latests = $this->news->categoryLatest();
        $CategoryPopulars = $this->category->showWithCount();
        return view('pages.user.category.index', compact('categories', 'subCategories', 'category', 'trendings','newsTop', 'latests', 'CategoryPopulars'));
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
    public function store(StoreNewsCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsCategory $newsCategory)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function showAll($slug)
    {
        $categories = $this->category->get();
        $subCategories = $this->subCategories->get();
        $popularCategory = $this->category->showWithCount();
        return view('pages.user.category.all-category', compact('news','categories', 'subCategories', 'popularCategory'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsCategory $newsCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsCategoryRequest $request, NewsCategory $newsCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsCategory $newsCategory)
    {
        //
    }
}
