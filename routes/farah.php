<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsReportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('contact/store', [ContactUsController::class, 'store'])->name('contact.send');
Route::post('news/draft', [NewsController::class, 'draft'])->name('news.draft');
Route::patch('news/banned/{news}', [NewsController::class, 'banned_news'])->name('news.banned');
Route::patch('news/unbanned/{news}', [NewsController::class, 'unbanned_news'])->name('news.unbanned');
Route::delete('news-report/{newsReport}', [NewsReportController::class, 'destroy'])->name('news-report.delete');