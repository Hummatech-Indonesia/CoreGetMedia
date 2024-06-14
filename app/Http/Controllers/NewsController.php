<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\CommentInterface;
use App\Contracts\Interfaces\NewsCategoryInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\NewsLikeInterface;
use App\Contracts\Interfaces\NewsSubCategoryInterface;
use App\Contracts\Interfaces\NewsTagInterface;
use App\Contracts\Interfaces\NewsViewInterface;
use App\Contracts\Interfaces\PopularInterface;
use App\Contracts\Interfaces\SubCategoryInterface;
use App\Contracts\Interfaces\TagInterface;
use App\Enums\NewsEnum;
use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\NewsCategory;
use App\Services\NewsService;
use App\Services\NewsViewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    private NewsInterface $news;
    private CategoryInterface $categories;
    private SubCategoryInterface $subcategories;
    private TagInterface $tags;
    private CommentInterface $comments;

    private NewsCategoryInterface $newscategories;
    private NewsSubCategoryInterface $newssubcategories;
    private NewsTagInterface $newstags;
    private NewsViewInterface $newsViews;
    private NewsLikeInterface $newsLikes;

    private NewsService $service;
    private NewsViewService $viewService;
    private PopularInterface $popularNews;

    public function __construct(
        NewsInterface $news,
        CategoryInterface $categories,
        SubCategoryInterface $subcategories,
        TagInterface $tags,
        CommentInterface $comments,
        NewsCategoryInterface $newscategories,
        NewsSubCategoryInterface $newssubcategories,
        NewsTagInterface $newstags,
        NewsViewInterface $newsViews,
        NewsLikeInterface $newsLikes,
        NewsViewService $viewService,
        NewsService $service,
        PopularInterface $popularNews,
        )
    {
        $this->news = $news;
        $this->categories = $categories;
        $this->subcategories = $subcategories;
        $this->tags = $tags;
        $this->comments = $comments;

        $this->newscategories = $newscategories;
        $this->newssubcategories = $newssubcategories;
        $this->newstags = $newstags;
        $this->newsViews = $newsViews;
        $this->newsLikes = $newsLikes;

        $this->viewService = $viewService;
        $this->service = $service;

        $this->popularNews = $popularNews;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $news = $this->news->show($user_id);
        return view('pages.author.news.list-news', compact('news'));
    }

    public function confirm_news()
    {
        $news = $this->news->where(NewsEnum::PENDING->value);
        return view('pages.admin.news.confirm-news', compact('news'));
    }

    public function pin_news(News $news)
    {
        $data['pin'] = 1;
        $this->news->update($news->id, $data);
        return back()->with('success', 'Berhasil mengpin berita');
    }

    public function unpin_news(News $news)
    {
        $data['pin'] = 0;
        $this->news->update($news->id, $data);
        return back()->with('success', 'Berhasil mengunpin berita');
    }

    public function news_list()
    {
        $news = $this->news->where(NewsEnum::ACCEPTED->value);
        return view('pages.admin.news.news-list', compact('news'));
    }

    public function detail_news_admin($news)
    {
        $news = $this->news->showWithSLug($news);
        $news_id = $news->id;
        $newsCategory = $this->newscategories->where($news_id);
        $newsSubcategory = $this->newssubcategories->where($news_id);
        $newsTags = $this->newstags->where($news_id, 'notop');
        return view('pages.admin.news.detail-news', compact('news', 'newsCategory', 'newsSubcategory', 'newsTags'));
    }

    public function approved_news($news)
    {
        $data['status'] = NewsEnum::ACCEPTED->value;
        $this->news->update($news, $data);
        return back()->with('success', 'Berhasil menerima berita');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categories->get();
        $tags = $this->tags->get();
        return view('pages.author.news.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $data = $this->service->store($request);
        if (auth()->user()->roles->pluck('name')[0] == "admin") {
            $data['status'] = NewsEnum::ACCEPTED->value;
        }
        $newsId = $this->news->store($data)->id;
        $this->service->storeRelation($newsId, $data['category'], $data['sub_category'], $data['tag']);
        return back()->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $slug)
    {
        $ipAddress = $request->ip();

        $news = $this->news->showWithSlug($slug);
        $news_id = $news->id;
        $data = $this->viewService->store($news_id, $ipAddress);
        $tags = $this->newstags->where($news_id, 'notop');
        $comments = $this->comments->get($news_id);
        $likes = $this->newsLikes->get($news_id);

        $likedByUser = $this->newsLikes->where($news_id, $ipAddress);

        $CategoryPopulars = $this->categories->showWithCount();
        $popularTags = $this->tags->showWithCount();
        return view('pages.user.singlepost.index', compact('likedByUser', 'news', 'news_id', 'CategoryPopulars', 'tags', 'popularTags', 'comments', 'likes'));
    }

    public function showPinned()
    {
        $newsPin = $this->news->allPin();
        $subCategories = $this->subcategories->get();

        $CategoryPopulars = $this->categories->showWithCount();
        $popularTags = $this->tags->showWithCount();
        return view('pages.user.news.all-news-pinned', compact('newsPin', 'subCategories', 'CategoryPopulars', 'popularTags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($news)
    {
        $news = $this->news->showWithSLug($news);
        $news_id = $news->id;

        $newsCategory = $this->newscategories->where($news_id);
        $newsSubcategory = $this->newssubcategories->where($news_id);
        $newsTags = $this->newstags->where($news_id, 'notop');

        $categories = $this->categories->get();
        $subcategories = $this->subcategories->get();
        $tags = $this->tags->get();

        // dd($news->image);
        return view('pages.author.news.update', compact('news','categories', 'subcategories','tags', 'newsCategory', 'newsSubcategory', 'newsTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $data = $this->service->update($request, $news);
        $data['status'] = NewsEnum::PENDING->value;
        $this->news->update($news->id, $data);
        $this->service->updateRelation($news->id, $data['category'], $data['sub_category'], $data['tag']);
        return back()->with('success', 'Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $this->newscategories->delete($news->id);
        $this->newssubcategories->delete($news->id);
        $this->newstags->delete($news->id);
        $this->news->delete($news->id);
        return back()->with('success', 'Berhasil menghapus data');
    }

    public function home(){
        $categories = $this->categories->get();
        $subCategories = $this->subcategories->get();
        return view('pages.index', compact('categories', 'subCategories'));
    }
    // public function showCategories($slug, Request $request, NewsCategory $newsCategory)
    // {
    //     $request->merge([
    //         'name' => $newsCategory->id,
    //     ]);

    //     $category = $this->category->showWithSlug($slug);
    //     $categoryId = $category->id;
    //     $subCategory = $this->subCategory->where($categoryId);

    //     $categories = $this->category->get();
    //     $totalCategories = $this->category->showWhithCount();
    //     $subCategories = $this->subCategory->get();
    //     $news = $this->news->showWhithCount();

    //     $query = $request->input('search');
    //     $newsCategories = $this->newsCategory->search($category->id, $query);

    //     $popular = $this->view->newsCategory($categoryId);

    //     $new_news = $this->news->newsCategorySearch($category->id, $query, 'terbaru', '5');
    //     $trending = $this->news->newsCategorySearch($category->id, $query, 'trending', '5');
    //     return view('pages.user.news.category', compact('trending','new_news','popular','news', 'totalCategories','subCategories','categories','category', 'subCategory', 'newsCategories'));
    // }

    public function latestNews(){
        $news = $this->news->latest();
        $CategoryPopulars = $this->categories->showWithCount();
        $popularTags = $this->tags->showWithCount();
        $subCategories = $this->subcategories->get();

        return view('pages.user.news.all-news-latest', compact('news', 'CategoryPopulars', 'popularTags', 'subCategories'));
    }

    public function popularNews()
    {
        $popular = $this->popularNews->getpopular();
        $CategoryPopulars = $this->categories->showWithCount();
        $popularTags = $this->tags->showWithCount();
        $subCategories = $this->subcategories->get();

        return view('pages.user.news.all-news-popular', compact('popular','CategoryPopulars', 'popularTags', 'subCategories'));
    }
}
