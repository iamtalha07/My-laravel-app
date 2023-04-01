<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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
    Route::post('/store',[ProductController::class, 'store'])->name('store');
    Route::get('/fetch-products',[ProductController::class, 'fetchAllProducts'])->name('fetchProducts');
    Route::get('/edit',[ProductController::class, 'edit'])->name('edit');
    Route::post('/update',[ProductController::class, 'update'])->name('update');
    Route::post('/update',[ProductController::class, 'update'])->name('update');
    Route::delete('/delete', [ProductController::class, 'delete'])->name('delete');
});


