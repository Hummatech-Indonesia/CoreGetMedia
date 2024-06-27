<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
use Illuminate\Http\Request;
use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\NewsCategoryInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\SubCategoryInterface;
use App\Contracts\Interfaces\TagInterface;
use App\Enums\AdvertisementEnum;
use App\Models\NewsCategory;
use App\Http\Requests\StoreNewsCategoryRequest;
use App\Http\Requests\UpdateNewsCategoryRequest;

class NewsCategoryController extends Controller
{
    private NewsCategoryInterface $newsCategory;
    private NewsInterface $news;
    private CategoryInterface $category;
    private SubCategoryInterface $subCategories;
    private TagInterface $tags;
    private AdvertisementInterface $advertisements;

    public function __construct(NewsCategoryInterface $newsCategory, NewsInterface $news, CategoryInterface $category, SubCategoryInterface $subCategories, TagInterface $tags, AdvertisementInterface $advertisements)
    {
        $this->newsCategory = $newsCategory;
        $this->category = $category;
        $this->subCategories = $subCategories;
        $this->news = $news;
        $this->tags = $tags;
        $this->advertisements = $advertisements;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $slug)
    {
        $category = $this->category->showWithSLug($slug);
        $category_id = $category->id;

        $categories = $this->category->get();
        $subCategories = $this->subCategories->get();

        $query = $request->input('search');
        $trendings = $this->news->whereCategory($category_id, $query, 10);
        $newsTop = $this->news->whereCategory($category_id, 'top');
        $latests = $this->news->categoryLatest($category_id);
        $CategoryPopulars = $this->category->showWithCount();
        $popularTags = $this->tags->showWithCount();

        $advertisement = $this->advertisements->get();
        $advertisement_id = $advertisement->pluck('id');

        $advertisement_rights = $this->advertisements->wherePosition(AdvertisementEnum::CATEGORY, 'right');
        $advertisement_lefts = $this->advertisements->wherePosition(AdvertisementEnum::CATEGORY, 'left');
        $advertisement_tops = $this->advertisements->wherePosition(AdvertisementEnum::CATEGORY, 'top');
        $advertisement_unders = $this->advertisements->wherePosition(AdvertisementEnum::CATEGORY, 'under');
        $advertisement_mids = $this->advertisements->wherePosition(AdvertisementEnum::CATEGORY, 'mid');
        return view('pages.user.category.index', compact('categories', 'subCategories', 'category', 'trendings', 'newsTop', 'latests', 'CategoryPopulars', 'popularTags', 'advertisement_rights', 'advertisement_lefts', 'advertisement_tops', 'advertisement_unders', 'advertisement_mids'));
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
    public function showAll(Request $request, $slug)
    {
        $category = $this->category->showWithSLug($slug);
        $category_id = $category->id;

        $categories = $this->category->get();
        $subCategories = $this->subCategories->get();

        $query = $request->input('search');
        $news = $this->news->whereAllCategory($category_id);
        $popularCategory = $this->category->showWithCount();
        $popularTags = $this->tags->showWithCount();
        $newsTop = $this->news->whereCategory($category_id, 'top');
        $trendings = $this->news->whereCategory($category_id, $query, 10);

        $advertisement_rights = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'right');
        $advertisement_lefts = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'left');
        $advertisement_tops = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'top');
        $advertisement_unders = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'under');
        $advertisement_mids = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'mid');

        return view('pages.user.category.all-category', compact('category', 'news', 'categories', 'subCategories', 'popularCategory', 'popularTags', 'trendings', 'newsTop',  'advertisement_rights',
        'advertisement_lefts',
        'advertisement_tops',
        'advertisement_unders',
        'advertisement_mids'));
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
