<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdvertisementInterface;
use App\Contracts\Interfaces\AuthorInterface;
use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\NewsLikeInterface;
use App\Contracts\Interfaces\NewsViewInterface;
use App\Contracts\Interfaces\PopularInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Enums\AdvertisementEnum;
use App\Enums\AuthorEnum;
use App\Enums\RoleEnum;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\User;
use App\Services\AuthorChartService;
use App\Services\AuthorService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private AuthorInterface $author;
    private NewsInterface $news;
    private NewsLikeInterface $newsLike;
    private NewsViewInterface $newsView;
    private CategoryInterface $category;
    private PopularInterface $popular;
    private UserInterface $user;
    private AuthorService $service;
    private UserService $userService;
    private AuthorChartService $authorChart;
    private AdvertisementInterface $advertisements;

    public function __construct(UserInterface $user, AuthorInterface $author, AuthorService $service, NewsInterface $news, CategoryInterface $category, PopularInterface $popular, NewsLikeInterface $newsLike, NewsViewInterface $newsView, UserService $userService, AuthorChartService $authorChart, AdvertisementInterface $advertisements)
    {
        $this->author = $author;
        $this->news = $news;
        $this->category = $category;
        $this->popular = $popular;
        $this->user = $user;
        $this->service = $service;
        $this->newsLike = $newsLike;
        $this->newsView = $newsView;
        $this->userService = $userService;
        $this->authorChart = $authorChart;
        $this->advertisements = $advertisements;
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
    public function store(Request $req, StoreAuthorRequest $request)
    {
        $data = $this->service->store($request, '');
        $data['description'] = $req->input('description');
        $this->user->update(auth()->user()->id, [
            'phone_number' => $req->input('phone_number'),
            'address' => $req->input('address')
        ]);
        $this->author->store($data);
        return back()->with('success', 'Berhasil mendaftarkan diri');
    }

    public function storeByAdmin(StoreAuthorRequest $request)
    {
        $user = $this->service->storeUser($request);
        $user = $this->user->store($user);
        $user_id = $user->assignRole(RoleEnum::AUTHOR->value)->id;
        $data = $this->service->store($request, $user_id);
        $this->author->store($data);

        return back()->with('success', 'Berhasil membuat akun author');
    }
    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $slug_id = $this->user->showWithSLug($slug);
        $author = $this->author->show($slug_id->id);
        $newses = $this->news->whereUser($slug_id->id)->paginate(10);
        $popularCategories = $this->category->showWithCount();
        $popularNewses = $this->popular->getpopular();

        $advertisement_rights = $this->advertisements->wherePosition(AdvertisementEnum::DETAIL_AUTHOR, 'right');
        $advertisement_lefts = $this->advertisements->wherePosition(AdvertisementEnum::DETAIL_AUTHOR, 'left');
        $advertisement_tops = $this->advertisements->wherePosition(AdvertisementEnum::DETAIL_AUTHOR, 'top');
        $advertisement_unders = $this->advertisements->wherePosition(AdvertisementEnum::DETAIL_AUTHOR, 'under');
        $advertisement_mids = $this->advertisements->wherePosition(AdvertisementEnum::DETAIL_AUTHOR, 'mid');

        return view('pages.user.author.detail-author', compact('author', 'newses', 'popularCategories', 'popularNewses', 'advertisement_rights', 'advertisement_lefts', 'advertisement_tops', 'advertisement_unders', 'advertisement_mids'));
    }

    public function statistic()
    {
        $newsLike = $this->newsLike->count(auth()->user()->id);
        $newses = $this->news->whereUser(auth()->user()->id);
        $newsView = $this->newsView->show(auth()->user()->id);
        $newsPopulers = $this->news->whereUser(auth()->user()->id);
        $news = $this->news;
        $chartData = $this->authorChart->chart($news);
        // dd($chartData);
        return view('pages.author.news.statistic', compact('newsLike', 'newses', 'newsView', 'newsPopulers', 'chartData'));
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
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }

    public function landing()
    {
        $authors = $this->author->accepted();
        return view('pages.user.author.list-author', compact('authors'));
    }

    public function confirm(Author $author)
    {
        $this->author->update($author->id, ['status' => AuthorEnum::ACCEPTED->value]);
        $user = $author->user;
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->assignRole(RoleEnum::AUTHOR->value);
        return back()->with(['success' => 'Author Berhasil Dikonfirmasi']);
    }

    public function reject(Request $request, Author $author)
    {
        $this->author->update($author->id, [
            'status' => AuthorEnum::REJECT->value,
            'reject_description' => $request->reject_description,
        ]);
        return redirect()->back()->with(['success' => 'Author Berhasil Tolak']);
    }
}
