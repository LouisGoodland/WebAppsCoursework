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

Route::post('/posts/{post}/commenting', [CommentController::class, 'apiStore'])
->name("api.comment.post")->middleware('auth:sanctum');

Route::get('/posts/{post}', [PostController::class, 'apiShow'])
->name("api.specific.post")->middleware('auth:sanctum');

//Route::get('/my_account/notifications', [NotificationController::class, 'show'])
//->name("notifications")->middleware('auth');

Route::get('/posts/{post}', [PostController::class, 'apiShow'])
->name("api.specific.post")->middleware('auth:sanctum');



