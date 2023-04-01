<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//User route
Route::middleware(['auth','user-role:customer'])->group(function(){
    Route::get('/home',[HomeController::class, 'customerDashboard'])->name('home');
});

// //Admin route
Route::middleware(['auth','user-role:admin'])->prefix('admin')->group(function(){
    Route::get('/home',[HomeController::class, 'adminDashboard'])->name('home.admin');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
