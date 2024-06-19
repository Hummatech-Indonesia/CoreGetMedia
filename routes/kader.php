<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::patch('banned-user/{user}' , [UserController::class ,'banned']);
Route::patch('active-user/{user}' , [UserController::class ,'active']);
Route::put('/confirm-author/{author}', [AuthorController::class, 'confirm'])->name('author.confirm');
Route::put('/reject-author/{author}', [AuthorController::class, 'reject'])->name('author.reject');

