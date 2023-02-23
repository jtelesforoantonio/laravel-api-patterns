<?php

use Illuminate\Support\Facades\Route;
use Modules\Posts\Http\Controllers\PostCommentController;
use Modules\Posts\Http\Controllers\PostController;

Route::apiResource('posts', PostController::class);
Route::apiResource('posts.comments', PostCommentController::class)->only(['index', 'store']);
