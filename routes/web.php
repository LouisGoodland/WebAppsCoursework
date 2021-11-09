<?php

use Illuminate\Support\Facades\Route;

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

//This is a route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

//This a route for the home page
Route::get('/home/{name}', function($name){
    return view('home', ['name'=>$name]);
});

//This will be for the feed page
Route::get('/feed/{name}', function($name){
    return view('home', ['name'=>$name]);
});

//This will be for the notifications page
Route::get('/feed/{name}', function($name){
    return view('home', ['name'=>$name]);
});

//This will be for the account settings page 
Route::get('/account/settings/{name}', function($name){
    return view('home', ['name'=>$name]);
});

//This will be for the account posts page 
Route::get('/account/posts/{name}', function($name){
    return view('home', ['name'=>$name]);
});

//This is a route for the dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
