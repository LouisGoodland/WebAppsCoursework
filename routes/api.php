<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts/{post}', [PostController::class, 'post_attributes'])
->name("api.specific.post")->middleware('auth');

Route::get('/posts/{post}/fetch_comments', [CommentController::class, 'api_show'])
->name("api.specific.post.comments")->middleware('auth');

Route::post('/posts/{post}/post_comments', [CommentController::class, 'api_store'])
->name("api.specific.post.create.comments")->middleware('auth');

Route::post('/posts/{post}/like', [PostController::class, 'api_like'])
->name("api.specific.post.like")->middleware('auth');
Route::post('/posts/{post}/dislike', [PostController::class, 'api_dislike'])
->name("api.specific.post.dislike")->middleware('auth');





