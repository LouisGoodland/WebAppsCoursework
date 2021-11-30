<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FriendshipController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//pages for showing accounts
Route::get('/accounts', [AccountController::class, 'index'])
->name("discover.accounts")->middleware('auth');
Route::get('/accounts/friends', [AccountController::class, 'index_friends'])
->name("discover.accounts.friends")->middleware('auth');
Route::get('/accounts/new', [AccountController::class, 'index_new'])
->name("discover.accounts.new")->middleware('auth');

//pages for showing posts
Route::get('/posts', [PostController::class, 'index'])
->name("discover.posts")->middleware('auth');
Route::get('/posts/friends', [PostController::class, 'index_friends'])
->name("discover.posts.friends")->middleware('auth');
Route::get('/posts/new', [PostController::class, 'index_new'])
->name("discover.posts.new")->middleware('auth');

//Routes for viewing specific accounts and posts
Route::get('/accounts/{account}', [AccountController::class, 'show'])
->name("specific.account")->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show'])
->name("specific.post")->middleware('auth');

//for editing the users profile
Route::get('/edit_profile', [AccountController::class, 'edit'])
->name("edit.account")->middleware('auth');
Route::post('/edit_profile/update', [AccountController::class, 'update'])
->name("update.account")->middleware('auth');

//Routes for adding likes and dislikes
Route::post('/posts/{post}/adding_like', [PostController::class, 'add_like'])
->name("post.add_like")->middleware('auth');
Route::post('/posts/{post}/adding_dislike', [PostController::class, 'add_dislike'])
->name("post.add_dislike")->middleware('auth');

//for creating a new post
Route::get('/create_post', [PostController::class, 'create'])
->name("create.post")->middleware('auth');
Route::post('/create_post/creating', [PostController::class, 'store'])
->name("store.post")->middleware('auth');

//for editing a post
Route::get('/edit_post/{post}', [PostController::class, 'edit'])
->name("edit.post")->middleware('auth');
Route::post('/edit_post/{post}/update', [PostController::class, 'update'])
->name("update.post")->middleware('auth');
Route::post('/edit_post/{post}/delete', [PostController::class, 'destroy'])
->name("destroy.post")->middleware('auth');

//Looking at notifications
Route::get('/notifications', [NotificationController::class, 'show'])
->name("notifications")->middleware('auth');

//for adding and deleting friends
Route::post('/accounts/{account}/adding_friend', [FriendshipController::class, 'create'])
->name("add.friend")->middleware('auth');
Route::post('/accounts/{account}/deleting_friend', [FriendshipController::class, 'destroy'])
->name("delete.friend");

//shows all the user friends
Route::get('/friendships', [FriendshipController::class, 'index'])
->name("friends")->middleware('auth');
Route::get('/friendships/following', [FriendshipController::class, 'index_following'])
->name("friends.following")->middleware('auth');
Route::get('/friendships/followers', [FriendshipController::class, 'index_followers'])
->name("friends.followers")->middleware('auth');
Route::get('/friendships/follow_back', [FriendshipController::class, 'index_follow_back'])
->name("friends.follow_back")->middleware('auth');

//routes for deciding if an admin
Route::get('/not_an_admin', [AccountController::class, 'revealIfAdmin'])
->name("admin.is_not_a")->middleware('auth');
Route::post('/not_an_admin', [AccountController::class, 'makeAdmin'])
->name("admin.make")->middleware('auth');

//admin to view all notifications
Route::get('/admin/notifications',  [NotificationController::class, 'index'])
->name("admin.notifications")->middleware('auth');

//admin ability to delete user
Route::post('/account/{account}', [AccountController::class, 'destroy'])
->name("admin.delete.account")->middleware('auth');


//default routes
//This is a route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

//This is a route for the dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
