<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UserController;
use Modules\Users\Http\Controllers\UserPostController;

Route::name('users.')->group(function () {
    Route::get('users/{user}/posts', [UserPostController::class, 'index'])->name('posts');
});
Route::apiResource('users', UserController::class);
