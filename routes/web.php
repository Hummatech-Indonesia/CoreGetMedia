<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeFaqController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsSubCategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\VoucherrController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsLikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('pages.index');
// });
Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('navbar-user', [NewsController::class, 'navbar'])->name('navbar');

// ----- ADMIN -----
Route::get('/dashboard', function () {
    return view('pages.admin.home.index');
})->name('dashboard.admin');

Route::get('category-list', [CategoryController::class, 'index'])->name('category.list.admin');
Route::put('category-update/{category}', [CategoryController::class, 'update'])->name('category.update.admin');
Route::delete('category-delete/{category}', [CategoryController::class, 'destroy'])->name('category.delete.admin');
Route::resource('category', CategoryController::class);

Route::get('subcategory-list/{category}', [SubCategoryController::class, 'index'])->name('subcategory.list.admin');
Route::post('subcategory-create/{category}', [SubCategoryController::class, 'store'])->name('subcategory.create.admin');
Route::put('subcategory-update/{subCategory}', [SubCategoryController::class, 'update'])->name('subcategory.update.admin');
Route::delete('subcategory-delete/{subCategory}', [SubCategoryController::class, 'destroy'])->name('subcategory.delete.admin');

Route::get('faq-list', [FaqController::class, 'index'])->name('faq.list.admin');
Route::post('faq-list', [FaqController::class, 'store'])->name('faq.store.admin');
Route::put('faq-list/{faq}', [FaqController::class, 'update'])->name('faq.update.admin');
Route::delete('faq-list/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy.admin');

Route::get('tag-list', [TagsController::class, 'index'])->name('tag.list.admin');
Route::post('tag-list', [TagsController::class, 'store'])->name('tag.store.admin');
Route::put('tag-list/{tags}', [TagsController::class, 'update'])->name('tag.update.admin');
Route::delete('tag-list/{tags}', [TagsController::class, 'destroy'])->name('tag.destroy.admin');

Route::get('voucher-list', [VoucherrController::class, 'index'])->name('voucher.list.admin');
Route::post('voucher-create', [VoucherrController::class, 'store'])->name('voucher.store.admin');
Route::put('voucher-update/{voucherr}', [VoucherrController::class, 'update'])->name('voucher.update.admin');
Route::delete('voucher-delete/{voucherr}', [VoucherrController::class, 'destroy'])->name('voucher.delete.admin');

Route::get('confirm-news', [NewsController::class, 'confirm_news'])->name('confirm.news.admin');
Route::get('detail-news/{news}', [NewsController::class, 'detail_news_admin'])->name('detail-news.admin');
Route::put('approved-news/{news}', [NewsController::class, 'approved_news'])->name('approved.news.admin');

Route::get('news-list', [NewsController::class, 'news_list'])->name('news-list.admin');

Route::get('confirm-author-list', [AuthorController::class, 'index'])->name('confirm-author.admin');
Route::get('author-list', [AuthorController::class, 'list_author'])->name('author-list.admin');

Route::get('admin-account-list', function () {
    return view('pages.admin.account.admin');
})->name('admin-account.list.admin');

Route::get('author-banned', function () {
    return view('pages.admin.author.author-banned');
})->name('author-banned.admin');

Route::get('user-account-list', [UserController::class, 'index'])->name('user-account.list.admin');
// Route::get('user-account-list', function(){
//     return view('pages.admin.account.user');
// })->name('user-account.list.admin');

Route::get('admin-account-list', function () {
    return view('pages.admin.account.admin');
})->name('admin-account.list.admin');

Route::get('singlepost/news', function () {
    return view('pages.user.singlepost.index');
})->name('singlepost.news');

Route::get('advertisement-list', function () {
    return view('pages.admin.advertisement.advertisement-list');
})->name(('advertisement-list.admin'));

Route::get('confirm-advertisement', function () {
    return view('pages.admin.advertisement.confirm-advertisement');
})->name('confirm-advertisement.admin');

Route::get('detail-advertisement', function () {
    return view('pages.admin.advertisement.detail-advertisement');
})->name('detail-advertisement.admin');

Route::get('about-getmedia', function () {
    return view('pages.admin.about.index');
})->name('about-getmedia.admin');

Route::get('inbox-admin', function () {
    return view('pages.admin.inbox.index');
})->name('inbox-list.admin');

Route::get('subscribe-list', function () {
    return view('pages.admin.subscribe.index');
})->name('subscribe-list.admin');

Route::get('news-premium', function () {
    return view('pages.admin.news_premium.index');
})->name('news-premium.admin');


// ----- USER -----
Route::get('all-subcategory', [NewsSubCategoryController::class, 'all_subcategory'])->name('all-subcategory.user');

Route::get('news/category', function () {
    return view('pages.user.category.index');
})->name('news.category');

Route::get('all-news', function () {
    return view('pages.user.all-news.index');
})->name('news.all-news');

Route::get('about-us', function () {
    return view('pages.user.aboutus.aboutus');
})->name('about.us');

Route::get('advertising', function () {
    return view('pages.user.ads.advertising');
})->name('user.ads.advertising');

Route::get('create-news', function () {
    return view('pages.author.news.create');
})->name('create.news');

//Author
Route::get('create-news', [NewsController::class, 'create'])->name('create.news');
Route::post('store-news', [NewsController::class, 'store'])->name('store.news');
Route::get('get-sub-category', [SubCategoryController::class, 'show'])->name('get.sub.category');
Route::get('list-news', [NewsController::class, 'index'])->name('news.list.author');
Route::get('edit-news/{news}', [NewsController::class, 'edit'])->name('edit.news');
Route::put('update-news/{news}', [NewsController::class, 'update'])->name('update.news');
Route::delete('delete-news/{news}', [NewsController::class, 'destroy'])->name('delete.news');


Route::get('news-statistic', function () {
    return view('pages.author.news.statistic');
})->name('news.author.statistic');

Route::get('list-delete-news', function () {
    return view('pages.author.news.list-delete');
})->name('news.delete.list.author');

Route::get('profile-author', function () {
    return view('pages.author.profile');
})->name('profile.author');

Route::get('faq', [HomeFaqController::class, 'index'])->name('faq-list.user');

// Route::get('profile-user', function () {
//     return view('pages.user.profile.index');
// })->name('profile-user.user');

Route::get('profile-user', [ProfileController::class, 'index'])->name('profile-user.user');

Route::get('profile-update', function () {
    return view('pages.user.profile.update');
})->name('profile-update.user');

Route::get('coin', function () {
    return view('pages.user.coin.index');
})->name('coin.user');

Route::get('exchange-coin', function () {
    return view('pages.user.coin.exchange-coin');
})->name('exchange-coin.user');

Route::get('history-coin', function () {
    return view('pages.user.coin.history');
})->name('history-coin.user');

// Route::get('news-liked', function () {
//     return view('pages.user.news-liked.index');
// })->name('news-liked.user');

Route::get('news-liked', [NewsLikeController::class, 'index'])->name('news-liked.user');

Route::get('contact-us', function () {
    return view('pages.user.contact-us.index');
})->name('contact-us.index');

Route::get('privacy-policy', function () {
    return view('pages.user.privacy-policy.index');
})->name('privacy-policy');

Route::get('list-tag', function () {
    return view('pages.user.tag.index');
})->name('list-tag.user');


// AUTHOR
// Route::get('list-author', function () {
//     return view('pages.user.author.list-author');
// })->name('user.list.author');

Route::get('inbox-user', function () {
    return view('pages.user.inbox.index');
})->name('inbox-user.user');

Route::get('jksaj', [NewsCategoryController::class, 'showAll'])->name('allcategory.user');
// Route::get('{category}', [NewsController::class, 'showCategories'])->name('categories.show.user'

Route::get('author', [AuthorController::class, 'landing'])->name('user.list.author');
Route::get('author/{author}', [AuthorController::class, 'show'])->name('author.detail');
Route::get('news/latest-news', [NewsController::class, 'latestNews'])->name('latest.news');
Route::get('news/popular-news', [NewsController::class, 'popularNews'])->name('popular.news');

Route::post('author-create', [AuthorController::class, 'store'])->name('author.create');

Route::get('author-registration', function () {
    return view('pages.user.profile.author-registration');
})->name('author-registration');


Route::get('all-pinned', [NewsController::class, 'showPinned'])->name('all-pinned-list.user');

Route::put('/blok-user/{user}', [UserController::class, 'banned'])->name('user.banned');


require_once __DIR__ . '/jovita.php';
require_once __DIR__ . '/ardi.php';
require_once __DIR__ . '/farah.php';
require_once __DIR__ . '/kader.php';