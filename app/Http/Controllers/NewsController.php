<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
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
use App\Enums\AdvertisementEnum;
use App\Enums\NewsEnum;
use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Advertisement;
use App\Models\NewsCategory;
use App\Services\ImageContentService;
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
    private ImageContentService $ImageContent;
    private AdvertisementInterface $advertisements;

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
        ImageContentService $ImageContent,
        AdvertisementInterface $advertisements
    ) {
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
        $this->ImageContent = $ImageContent;
        $this->advertisements = $advertisements;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $news = $this->news->showWithTrash($user_id, $request);
        $pendings = $this->news->userStatus($user_id, NewsEnum::PENDING->value, $request);
        $rejecteds = $this->news->userStatus($user_id, NewsEnum::REJECT->value, $request);
        $accepteds = $this->news->userStatus($user_id, NewsEnum::ACCEPTED->value, $request);
        $drafts = $this->news->draft();
        return view('pages.author.news.list-news', compact('news', 'pendings', 'rejecteds', 'accepteds', 'drafts'));
    }

    public function confirm_news(Request $request)
    {
        $news = $this->news->where(NewsEnum::PENDING->value, $request->opsiperpage, $request);
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

    public function banned_news(News $news)
    {
        $this->news->update($news->id, ['status' => NewsEnum::BANNED->value]);
        return back()->with('success', 'Berhasil banned berita');
    }

    public function unbanned_news(News $news)
    {
        $this->news->update($news->id, ['status' => NewsEnum::ACCEPTED->value]);
        return back()->with('success', 'Berhasil membuka banned berita');
    }

    public function news_list(Request $request)
    {
        $news = $this->news->where(NewsEnum::ACCEPTED->value, 10, $request);
        return view('pages.admin.news.news-list', compact('news'));
    }

    public function draft_list()
    {
        $news = $this->news->draft();
        return view('pages.admin.news.draft', compact('news'));
    }

    public function detail_news_admin($news)
    {
        $news = $this->news->showWithSLug($news);
        $news_id = $news->id;
        $newsCategory = $this->newscategories->where($news_id);
        $newsSubcategory = $this->newssubcategories->where($news_id);
        $newsTags = $this->newstags->wheretag($news_id);
        return view('pages.admin.news.detail-news', compact('news', 'newsCategory', 'newsSubcategory', 'newsTags'));
    }

    public function approved_news(News $news)
    {
        $data['status'] = NewsEnum::ACCEPTED->value;
        $this->news->update($news->id, $data);
        return redirect('/confirm-news')->with('success', 'Berhasil menerima berita');
    }

    public function reject_news(Request $request, News $news)
    {
        $this->news->update($news->id, [
            'status' => NewsEnum::REJECT->value,
            'reject_description' => $request->reject_description,
        ]);
        return redirect('/confirm-news')->with('success', 'Berhasil menolak berita');
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

        if (auth()->user()->roles->pluck('name')[0] == "admin") {
            return redirect('/news-list')->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect('/list-news')->with('success', 'Berhasil menambahkan data');
        }
    }

    public function draft(StoreNewsRequest $request)
    {
        $data = $this->service->store($request);

        $newsId = $this->news->store($data)->id;
        $this->service->storeRelation($newsId, $data['category'], $data['sub_category'], $data['tag']);
        $this->news->delete($newsId);

        if (auth()->user()->roles->pluck('name')[0] == "admin") {
            return redirect('/news-list')->with('success', 'Berhasil menyimpan draft');
        } else {
            return redirect('/list-news')->with('success', 'Berhasil menyimpan draft');
        }
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

        $content = $news->description;
        $processedContent = $this->ImageContent->insertImagesInContent($content);

        $newsTags = $this->newstags->wheretag($news_id);

        $advertisement_rights = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'right');
        $advertisement_lefts = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'left');
        $advertisement_tops = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'top');
        $advertisement_unders = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'under');
        $advertisement_mids = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'mid');

        return view('pages.user.singlepost.index', compact('ipAddress','likedByUser', 'news', 'news_id', 'CategoryPopulars', 'tags', 'popularTags', 'comments', 'likes', 'processedContent', 'newsTags', 'advertisement_rights', 'advertisement_lefts', 'advertisement_tops', 'advertisement_unders', 'advertisement_mids'));
    }

    public function showPinned()
    {
        $newsPin = $this->news->allPin();
        $subCategories = $this->subcategories->get();

        $CategoryPopulars = $this->categories->showWithCount();
        $popularTags = $this->tags->showWithCount();

        $advertisement_rights = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'right');
        $advertisement_lefts = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'left');
        $advertisement_tops = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'top');
        $advertisement_unders = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'under');
        $advertisement_mids = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'mid');
        return view('pages.user.news.all-news-pinned', compact('newsPin', 'subCategories', 'CategoryPopulars', 'popularTags', 'advertisement_rights', 'advertisement_lefts', 'advertisement_tops', 'advertisement_unders', 'advertisement_mids'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($news)
    {
        $news = $this->news->showWithSLug($news);
        $findDraft = $this->news->findDraft($news->id);

        $newsCategory = $this->newscategories->where($findDraft->id);
        $newsSubcategory = $this->newssubcategories->where($findDraft->id);
        $newsTags = $this->newstags->wheretag($findDraft->id);
        $categories = $this->categories->get();
        $subcategories = $this->subcategories->get();
        $tags = $this->tags->get();

        return view('pages.author.news.update', compact('news', 'categories', 'subcategories', 'tags', 'newsCategory', 'newsSubcategory', 'newsTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, $id)
    {
        $findDraft = $this->news->findDraft($id);
        $data = $this->service->update($request, $findDraft);
        if (auth()->user()->roles->pluck('name')[0] == "admin") {
            $data['status'] = NewsEnum::ACCEPTED->value;
        } else {
            $data['status'] = NewsEnum::PENDING->value;
        }
        $this->news->update($findDraft->id, $data);
        $this->service->updateRelation($findDraft->id, $data['category'], $data['sub_category'], $data['tag']);

        if (auth()->user()->roles->pluck('name')[0] == "admin") {
            return redirect('/news-list')->with('success', 'Berhasil update data');
        } else {
            return redirect('/list-news')->with('success', 'Berhasil update data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $findDraft = $this->news->findDraft($id);
        $this->newscategories->delete($findDraft->id);
        $this->newssubcategories->delete($findDraft->id);
        $this->newstags->delete($findDraft->id);
        $this->service->delete($findDraft);
        $findDraft->forceDelete();
        return back()->with('success', 'Berhasil menghapus data');
    }

    public function publish($id)
    {
        $findDraft = $this->news->findDraft($id);
        if($findDraft->trashed()){
            $findDraft->restore();
            if (auth()->user()->roles->pluck('name')[0] == "admin") {
                return redirect('/news-list')->with('success', 'Berhasil mengupload berita');
            } else {
                return redirect('/list-news')->with('success', 'Berhasil mengupload berita');
            }
        } else {
            if (auth()->user()->roles->pluck('name')[0] == "admin") {
                return redirect('/news-list')->with('warning', 'Draft tidak ditemukan');
            } else {
                return redirect('/list-news')->with('warning', 'Draft tidak ditemukan');
            }
        }
    }

    public function home()
    {
        $categories = $this->categories->get();
        $subCategories = $this->subcategories->get();
        return view('pages.index', compact('categories', 'subCategories'));
    }

    public function latestNews()
    {

        $news = $this->news->latest();
        $CategoryPopulars = $this->categories->showWithCount();
        $popularTags = $this->tags->showWithCount();
        $subCategories = $this->subcategories->get();

        $advertisement_rights = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'right');
        $advertisement_lefts = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'left');
        $advertisement_tops = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'top');
        $advertisement_unders = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'under');
        $advertisement_mids = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'mid');
        return view('pages.user.news.all-news-latest', compact('news', 'CategoryPopulars', 'popularTags', 'subCategories', 'advertisement_rights', 'advertisement_lefts', 'advertisement_tops', 'advertisement_unders', 'advertisement_mids'));
    }

    public function popularNews()
    {
        $popular = $this->popularNews->getpopular();
        $CategoryPopulars = $this->categories->showWithCount();
        $popularTags = $this->tags->showWithCount();
        $subCategories = $this->subcategories->get();

        $advertisement_rights = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'right');
        $advertisement_lefts = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'left');
        $advertisement_tops = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'top');
        $advertisement_unders = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'under');
        $advertisement_mids = $this->advertisements->wherePosition(AdvertisementEnum::ALLNEWS, 'mid');

        return view('pages.user.news.all-news-popular', compact('popular', 'CategoryPopulars', 'popularTags', 'subCategories', 'advertisement_rights', 'advertisement_lefts', 'advertisement_tops', 'advertisement_unders', 'advertisement_mids'));
    }
}
