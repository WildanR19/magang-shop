<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::resource('product-categories', App\Http\Controllers\ProductCategoryController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
});