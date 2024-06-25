<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdminInterface;
use App\Contracts\Interfaces\AuthorInterface;
use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Contracts\Interfaces\VisitorInterface;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminReqeust;
use App\Models\Admin;
use App\Models\User;
use App\Services\AdminChartService;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private AdminInterface $admins;
    private AdminService $admin;
    private UserInterface $users;
    private VisitorInterface $visitor;
    private AuthorInterface $author;
    private NewsInterface $news;
    private CategoryInterface $category;
    private AdminChartService $adminChart;

    public function __construct(AdminInterface $admins, UserInterface $users, AdminService $admin, VisitorInterface $visitor, AuthorInterface $author, NewsInterface $news, CategoryInterface $category, AdminChartService $adminChart)
    {
        $this->admins = $admins;
        $this->admin = $admin;
        $this->users = $users;
        $this->visitor = $visitor;
        $this->author = $author;
        $this->news = $news;
        $this->category = $category;
        $this->adminChart = $adminChart;
    }

    public function dashboard()
    {
        $visitors = $this->visitor->get()->count();
        $countAuthor = $this->author->accepted()->count();
        $countUser = $this->users->get()->count();
        $countNews = $this->news->accepted()->count();
        $newsPopulars = $this->news->newsPopularAdmin();
        $categoryPopulars = $this->category->showWithCount()->take(4);
        $newsChart = $this->adminChart->Chart($this->news);
        return view('pages.admin.home.index', compact('visitors', 'countAuthor', 'countUser', 'countNews', 'newsPopulars', 'categoryPopulars', 'newsChart'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = $this->admins->AccountAdmin();
        return view('pages.admin.account.admin', compact('admins'));
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
    public function store(StoreAdminRequest $request)
    {
        try {
            $data = $this->admin->storeOrUpdate($request);
            $user = $this->admins->store($data);
            $user->assignRole(RoleEnum::ADMIN->value);
            return redirect()->back()->with('success' , 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('Error' , 'Data sudah digunakan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminReqeust $request, User $admin)
    {
        try {
            $data = $this->admin->updateAdmin($request);
            $this->admins->update($admin->id, $data);
            return back()->with('success' , 'Data berhasil di perbarui');
        } catch (\Throwable $th) {
            return back()->with('Error' , 'Data sudah digunakan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        return back()->with('success' , 'Data berhasil di hapus');

        // try {
        //     $this->users->delete($user->id);
        // } catch (\Throwable $th) {
        //     return back()->with('success' , 'Data berhasil dihapus');
        // }
    }
}
