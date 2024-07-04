<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
use App\Models\NewsTag;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewsTagRequest;
use App\Http\Requests\UpdateNewsTagRequest;
use App\Contracts\Interfaces\NewsTagInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\TagInterface;
use App\Contracts\Interfaces\CategoryInterface;
use App\Enums\AdvertisementEnum;

class NewsTagController extends Controller
{
    private NewsInterface $news;
    private TagInterface $tag;
    private NewsTagInterface $tags;
    private CategoryInterface $category;
    private AdvertisementInterface $advertisements;

    public function __construct(NewsInterface $news, TagInterface $tag, NewsTagInterface $tags, CategoryInterface $category, AdvertisementInterface $advertisements)
    {
        $this->news = $news;
        $this->tag = $tag;
        $this->tags = $tags;
        $this->category = $category;
        $this->advertisements = $advertisements;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $slug)
    {
        $news = $this->tag->showWithSLug($slug);

        $query = $request->input('search');
        $news_tags = $this->news->whereTag($news->id, 'top');
        $trendings = $this->news->newsPopular();

        $trending_id = $trendings->pluck('id');
        $id = $news_tags->pluck('id');
        $ids = $trending_id->merge($id);

        $newsTags = $this->news->tagLatest($news->id, 0, $ids, 'notall')->paginate(5);
        $newsSeo = $this->news->tagLatest($news->id, 0, 0, '1')->get();

        $CategoryPopulars = $this->category->showWithCount();
        $popularTags = $this->tag->showWithCount();

        $advertisement_rights = $this->advertisements->wherePosition(AdvertisementEnum::TAG, 'right');
        $advertisement_lefts = $this->advertisements->wherePosition(AdvertisementEnum::TAG, 'left');
        $advertisement_tops = $this->advertisements->wherePosition(AdvertisementEnum::TAG, 'top');
        $advertisement_unders = $this->advertisements->wherePosition(AdvertisementEnum::TAG, 'under');
        $advertisement_mids = $this->advertisements->wherePosition(AdvertisementEnum::TAG, 'mid');

        return view('pages.user.tag.index', compact(
            'news_tags', 'news', 'newsTags', 'CategoryPopulars', 'trendings', 'popularTags'
        ,'advertisement_rights', 'advertisement_lefts', 'advertisement_tops', 'advertisement_unders', 'advertisement_mids', 'newsSeo'));
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
        $newsTags = $this->news->taglatest($news->id, 0, 0, 'all')->paginate(10);
        $CategoryPopulars = $this->category->showWithCount();
        $query = $request->input('search');
        $trendings = $this->news->whereCategory($news->id, $query);
        $popularTags = $this->tag->showWithCount();

        $advertisement_rights = $this->advertisements->wherePosition(AdvertisementEnum::TAG, 'right');
        $advertisement_lefts = $this->advertisements->wherePosition(AdvertisementEnum::TAG, 'left');
        $advertisement_tops = $this->advertisements->wherePosition(AdvertisementEnum::TAG, 'top');
        $advertisement_unders = $this->advertisements->wherePosition(AdvertisementEnum::TAG, 'under');
        $advertisement_mids = $this->advertisements->wherePosition(AdvertisementEnum::TAG, 'mid');
        return view('pages.user.tag.all-tag', compact(
            'news', 'newsTags', 'CategoryPopulars', 'trendings', 'popularTags', 'advertisement_rights', 'advertisement_lefts', 'advertisement_tops', 'advertisement_unders', 'advertisement_mids'));
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
