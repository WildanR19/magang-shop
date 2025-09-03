<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('category', [HomeController::class, 'category'])->name('category');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::resource('product-categories', App\Http\Controllers\ProductCategoryController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
});
