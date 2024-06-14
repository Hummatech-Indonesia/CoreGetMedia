<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::patch('banned-user/{user}' , [UserController::class ,'banned']);
Route::put('/confirm-author/{author}', [AuthorController::class, 'confirm'])->name('author.confirm');

