<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\FaqInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\PopularInterface;
use App\Contracts\Interfaces\SubCategoryInterface;
use App\Contracts\Interfaces\TagInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private FaqInterface $faqs;
    private NewsInterface $news;
    private CategoryInterface $categories;
    private SubCategoryInterface $subCategories;
    private PopularInterface $populars;
    private TagInterface $tags;
    private AdvertisementInterface $advertisements;

    public function __construct(NewsInterface $news, FaqInterface $faqs, CategoryInterface $categories, SubCategoryInterface $subCategories, PopularInterface $populars, TagInterface $tags, AdvertisementInterface $advertisements)
    {
        $this->faqs = $faqs;
        $this->categories = $categories;
        $this->subCategories = $subCategories;
        $this->populars = $populars;
        $this->news = $news;
        $this->tags = $tags;
        $this->advertisements = $advertisements;
    }

    public function index(){
        $populars = $this->populars->getpopular();
        $popular_id = $populars->pluck('id');
        $latests = $this->populars->getlatest();
        $tags = $this->tags->showWithCount();
        $category_id_1 = $this->categories->category_id_1();
        $category_id_2 = $this->categories->category_id_2();

        $newsPins = $this->news->news_pin();
        $newsPin_id = $newsPins->pluck('id');
        $categoryPopulars = $this->populars->getbycategory($category_id_1);
        $category2Populars = $this->populars->getbycategory($category_id_2);
        $popularCategories = $this->categories->showWithCount();

        $categoriesPin = $this->news->news_pin_categories();
        $newsByCategory = [];

        foreach ($categoriesPin as $category) {
            $newsByCategory[$category->name] = $this->news->news_by_category($category->name);
        }

        $advertisement = $this->advertisements->get();
        $advertisement_id = $advertisement->pluck('id');

        $advertisement_rights = $this->advertisements->wherePosition($advertisement_id, 'right');

        return view('pages.index', compact('populars', 'categoryPopulars' ,'latests', 'category2Populars', 'tags', 'newsPins', 'popularCategories', 'categoriesPin', 'newsByCategory','advertisement_rights'));
    }

    public function navbar(Request $request){
        $categories = $this->categories->get();
        $subCategories = $this->subCategories->get();

        $news = $this->news->get();
        // $query = $request->input('search');
        // $newsSearch = $this->news->searchAll($request, $query);
        return view('layouts.user.navbar-header', compact('categories', 'subCategories','newsSearch'));
    }

    public function mobileHeader(){
        $categories = $this->categories->get();
        $subCategories = $this->subCategories->get();
        return view('layouts.user.mobile-navbar', compact('categories', 'subCategories'));
    }
}
