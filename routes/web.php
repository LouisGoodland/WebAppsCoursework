<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PostController;

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


//for looking at different users
//This will be changed to only show accounts that the user logged in can't view
Route::get('/discover_accounts', [AccountController::class, 'index']);
Route::get('/discover_accounts/{account}', [AccountController::class, 'show']);

//for looking at new posts
Route::get('/discover', [PostController::class, 'index']);
Route::get('/discover/{post}', [PostController::class, 'show']);

//This will change (get rid of account, just have logged in details)
//for looking at posts from accounts that the user follows
Route::get('/following/{account}', [PostController::class, 'index']);




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
