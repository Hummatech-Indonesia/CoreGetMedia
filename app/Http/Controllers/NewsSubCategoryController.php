<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
use Illuminate\Http\Request;
use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\NewsCategoryInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\NewsSubCategoryInterface;
use App\Contracts\Interfaces\TagInterface;
use App\Contracts\Interfaces\SubCategoryInterface;
use App\Enums\AdvertisementEnum;
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
    private AdvertisementInterface $advertisements;

    public function __construct(
        NewsSubCategoryInterface $newsSubCategory,
        TagInterface $tags,
        NewsCategoryInterface $newsCategory,
        NewsInterface $news,
        CategoryInterface $category,
        SubCategoryInterface $subCategories,
        AdvertisementInterface $advertisements
    ) {
        $this->newsSubCategory = $newsSubCategory;
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
        $idTop = $newsTop->pluck('id');
        $newsPopulars = $this->news->whereSubCategory($subcategory_id, 'notop');
        $idPop = $newsPopulars->pluck('id');
        $ids = $idTop->merge($idPop);

        $news = $this->news->subcategoryLatest($subcategory_id, $ids, '0')->paginate(5);
        $newsSeo = $this->news->subcategoryLatest($subcategory_id, ['1'], '1')->first();
        $popularCategory = $this->category->showWithCount();
        $popularTags = $this->tags->showWithCount();

        $advertisement_rights = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'right');
        $advertisement_lefts = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'left');
        $advertisement_tops = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'top');
        $advertisement_unders = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'under');
        $advertisement_mids = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'mid');

        return view('pages.user.subcategory.index',
            compact(
                'newsSeo',
                'categories',
                'subCategories',
                'news',
                'newsTop',
                'popularCategory',
                'newsPopulars',
                'subcategory',
                'popularTags',
                'advertisement_rights',
                'advertisement_lefts',
                'advertisement_tops',
                'advertisement_unders',
                'advertisement_mids'
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
        $newsPopulars = $this->news->whereSubCategory($subCategory_id, 'notop');
        $news = $this->news->whereAllSubCategory($subCategory_id);
        $popularCategory = $this->category->showWithCount();
        $popularTags = $this->tags->showWithCount();
        $newsTop = $this->news->whereSubCategory($subCategory_id, 'top');

        $advertisement_rights = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'right');
        $advertisement_lefts = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'left');
        $advertisement_tops = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'top');
        $advertisement_unders = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'under');
        $advertisement_mids = $this->advertisements->wherePosition(AdvertisementEnum::SUBCATEGORY, 'mid');
        return view(
            'pages.user.subcategory.all-subcategory',
            compact(
                'subCategory',
                'news',
                'categories',
                'subCategories',
                'popularCategory',
                'popularTags',
                'newsPopulars',
                'newsTop',
                'advertisement_rights',
                'advertisement_lefts',
                'advertisement_tops',
                'advertisement_unders',
                'advertisement_mids'
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
