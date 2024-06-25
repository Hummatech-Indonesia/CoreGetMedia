<?php

use App\Http\Controllers\AdvertisementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentReportController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsLikeController;
use App\Http\Controllers\NewsRejectController;
use App\Http\Controllers\NewsReportController;
use App\Http\Controllers\NewsSubCategoryController;
use App\Http\Controllers\PositionAdvertisementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

Route::get('news/{slug}', [NewsCategoryController::class, 'index'])->name('news.category.user');
Route::get('news/subcategory/{slug}', [NewsSubCategoryController::class, 'index'])->name('news.subcategory');

Route::get('author-list', [AuthorController::class, 'list_author'])->name('author-list.admin');

Route::post('comment-create/{news}', [CommentController::class, 'store'])->name('comment.create');
Route::post('reply-comment-create/{news}/{comment}', [CommentController::class, 'reply'])->name('reply.create');

Route::put('update-comment/{comment}', [CommentController::class, 'update'])->name('update.comment');
Route::delete('delete-comment/{comment}', [CommentController::class, 'destroy'])->name('delete.comment');
Route::post('comment-report/{comment}', [CommentReportController::class, 'store'])->name('report.comment');

Route::put('pin-news/{news}', [NewsController::class, 'pin_news'])->name('pin.news.admin');
Route::put('unpin-news/{news}', [NewsController::class, 'unpin_news'])->name('unpin.news.admin');

Route::post('like-news/{news}', [NewsLikeController::class, 'store'])->name('like.news');
Route::delete('unlike-news/{news}', [NewsLikeController::class, 'destroy'])->name('unlike.news');

Route::post('news-report/{news}', [NewsReportController::class, 'store'])->name('report.news');
Route::put('reject-news/{news}', [NewsController::class, 'reject_news'])->name('reject.news.admin');

Route::post('image-update/{user}', [UserController::class, 'updateImage'])->name('image.update');
Route::put('update-profile/{user}', [UserController::class, 'update'])->name('update.profile');
Route::post('update-password/{user}', [UserController::class, 'updatePassword'])->name('update.password');

Route::post('position-price', [PositionAdvertisementController::class, 'store'])->name('edit.position.price');

Route::put('reject-advertisement/{advertisement}', [AdvertisementController::class, 'rejected'])->name('reject.advertisement.admin');
Route::put('accepted-advertisement/{advertisement}', [AdvertisementController::class, 'accepted'])->name('accepted.advertisement.admin');

Route::middleware('auth')->group(function () {
    Route::post('follow-author/{author}', [FollowerController::class, 'store'])->name('follow.author');
    Route::delete('unfollow-author/{author}', [FollowerController::class, 'destroy'])->name('unfollow.author');
});

Route::put('update-draft-advertisement/{id}', [AdvertisementController::class, 'updateDraft'])->name('advertisement.updatedraft');
Route::put('recovery-draft-advertisement/{id}', [AdvertisementController::class, 'notDraft'])->name('recovery.advertisement');
