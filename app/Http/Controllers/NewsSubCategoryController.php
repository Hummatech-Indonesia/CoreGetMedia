<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\NewsCategoryInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\NewsSubCategoryInterface;
use App\Contracts\Interfaces\TagInterface;
use App\Contracts\Interfaces\SubCategoryInterface;
use App\Models\NewsSubCategory;
use App\Http\Requests\StoreNewsSubCategoryRequest;
use App\Http\Requests\UpdateNewsSubCategoryRequest;

class NewsSubCategoryController extends Controller
{
    private NewsCategoryInterface $newsCategory;
    private NewsSubCategoryInterface $newsSubCategory;
    private NewsInterface $news;
    private CategoryInterface $category;
    private SubCategoryInterface $subCategories;
    private TagInterface $tags;

    public function __construct(
        NewsSubCategoryInterface $newsSubCategory,
        TagInterface $tags,
        NewsCategoryInterface $newsCategory,
        NewsInterface $news,
        CategoryInterface $category,
        SubCategoryInterface $subCategories
    ) {
        $this->newsSubCategory = $newsSubCategory;
        $this->newsCategory = $newsCategory;
        $this->category = $category;
        $this->subCategories = $subCategories;
        $this->news = $news;
        $this->tags = $tags;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        $subcategory = $this->subCategories->showWithSlug($slug);
        if (!$subcategory) {
            return redirect()->back()->withErrors(['Subcategory not found']);
        }

        $subcategory_id = $subcategory->id;
        $categories = $this->category->get();
        $subCategories = $this->subCategories->get();
        $newsTop = $this->news->whereSubCategory($subcategory_id, 'top');
        $news = $this->news->whereSubCategory($subcategory_id, 'notop');
        $newsPopulars = $this->news->whereSubCategory($subcategory_id, 'popular');
        $popularCategory = $this->category->showWithCount();
        $popularTags = $this->tags->showWithCount();

        return view(
            'pages.user.subcategory.index',
            compact(
                'categories',
                'subCategories',
                'news',
                'newsTop',
                'popularCategory',
                'newsPopulars',
                'subcategory',
                'popularTags'
            )
        );
    }

    public function all_subcategory()
    {
        $categories = $this->category->get();
        $subCategories = $this->subCategories->get();
        $news = $this->newsSubCategory->get();
        $popularCategory = $this->category->showWithCount();
        $popularTags = $this->tags->showWithCount();

        return view(
            'pages.user.subcategory.all-subcategory',
            compact(
                'news',
                'categories',
                'subCategories',
                'popularCategory',
                'popularTags'
            )
        );
    }

    public function showAll(Request $request, $slug)
    {
        $subCategory = $this->subCategories->showWithSlug($slug);
        if (!$subCategory) {
            return redirect()->back()->withErrors(['Subcategory not found']);
        }

        $subCategory_id = $subCategory->id;
        $categories = $this->category->get();
        $subCategories = $this->subCategories->get();
        $query = $request->input('search');
        $news = $this->news->whereSubCategory($subCategory_id, $query);
        $popularCategory = $this->category->showWithCount();
        $popularTags = $this->tags->showWithCount();

        return view(
            'pages.user.subcategory.all-subcategory',
            compact(
                'subCategory',
                'news',
                'categories',
                'subCategories',
                'popularCategory',
                'popularTags'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Code for creating a new resource
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsSubCategoryRequest $request)
    {
        // Code for storing a new resource
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsSubCategory $newsSubCategory)
    {
        // Code for displaying a specific resource
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsSubCategory $newsSubCategory)
    {
        // Code for editing a specific resource
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsSubCategoryRequest $request, NewsSubCategory $newsSubCategory)
    {
        // Code for updating a specific resource
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsSubCategory $newsSubCategory)
    {
        // Code for deleting a specific resource
    }
}
