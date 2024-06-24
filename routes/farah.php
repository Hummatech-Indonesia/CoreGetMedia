<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('contact/store', [ContactUsController::class, 'store'])->name('contact.send');
Route::post('news/draft', [NewsController::class, 'draft'])->name('news.draft');