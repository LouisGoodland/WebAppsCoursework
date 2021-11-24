<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NotificationController;

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


//These are pages for viewing lots of users
//This will be changed to only show accounts that the user logged in can't view
Route::get('/discover_accounts', [AccountController::class, 'index'])
->name("discover.accounts")->middleware('auth');
Route::get('/discover_accounts/{account}', [AccountController::class, 'show'])
->name("specific.account");
//Account login / creation
//Route::get('/login')
Route::get('/create_account', [AccountController::class, 'create'])
->name("create.account");
Route::post('/discover_accounts', [AccountController::class, 'store'])
->name("store.account");
//Route::get('/edit_profile', [AccountController::class, 'edit'])


//for looking at new posts
Route::get('/discover', [PostController::class, 'index'])
->name("discover.posts");
Route::get('/discover/{post}', [PostController::class, 'show'])
->name("specific.post");
//adding a like to the specific post
Route::post('/discover/{post}/adding_like', [PostController::class, 'add_like'])
->name("post.add_like");
Route::post('/discover/{post}/adding_dislike', [PostController::class, 'add_dislike'])
->name("post.add_dislike");

//creates a new post
//Waiting for authentication to create the rest
Route::get('/create_post', [PostController::class, 'create'])
->name("create.post");
Route::post('/discover', [PostController::class, 'store'])
->name("store.post");


//Route::post('/discover/{post}', [PostController::class, 'add_like']);

//This will change (get rid of account, just have logged in details)
//for looking at posts from accounts that the user follows

//Looking at notifications (all for now but should be simplified)
Route::get('/notifications', [NotificationController::class, 'index'])
->name("notifications");
//Route::post('/discover_accounts/{accounts}')





//default 

//This is a route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

//This is a route for the dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
