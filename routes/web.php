<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

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

//Route::resource('accounts', AccountController::class);

Route::get('/specialroute', [AccountController::class, 'index']);
Route::get('/specialroute/{account}', [AccountController::class, 'show']);



//This a route for the home page
Route::get('/home/{name}', function($name){
    return view('home', ['name'=>$name]);
});


//This is a route for the dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
