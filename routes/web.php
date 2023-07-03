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
    Route::get('/',[HomeController::class, 'dashboard'])->name('home');
    Route::get('/fetch-products',[ProductController::class, 'fetchAllProducts'])->name('fetchProducts');
    Route::post('/store',[ProductController::class, 'store'])->name('store');
    Route::get('/edit',[ProductController::class, 'edit'])->name('edit');
    Route::post('/update',[ProductController::class, 'update'])->name('update');
    Route::delete('/delete', [ProductController::class, 'delete'])->name('delete');


