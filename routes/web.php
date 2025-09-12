<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\CustomerAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('category', [HomeController::class, 'category'])->name('category');
Route::get('product/{id}/detail', [HomeController::class, 'productDetail'])->name('product.detail');
Route::get('product/{product}/reviews', [HomeController::class, 'showMoreReviews'])->name('product.reviews');
Route::group(['middleware' => [CustomerAuth::class]], function () {
    Route::get('cart/add/{id}', [HomeController::class, 'addToCart'])->name('cart.add');
    Route::post('cart/add/{id}', [HomeController::class, 'addMultipleToCart'])->name('cart.addMultiple');
    Route::get('cart', [HomeController::class, 'cart'])->name('cart');
    Route::get('cart/decrement/{id}', [HomeController::class, 'decrementCart'])->name('cart.decrement');
    Route::get('cart/increment/{id}', [HomeController::class, 'incrementCart'])->name('cart.increment');
    Route::get('cart/remove/{id}', [HomeController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('cart/clear', [HomeController::class, 'clearCart'])->name('cart.clear');
    Route::get('account', [HomeController::class, 'account'])->name('account');
    Route::post('checkout', [HomeController::class, 'processCheckout'])->name('checkout.process');
    Route::get('wishlist/add/{id}', [HomeController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('buy_now/{id}', [HomeController::class, 'buyNow'])->name('buy.now');
});
Route::get('checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('login', function () {
    return view('login');
})->name('user.login');
Route::post('login', [HomeController::class, 'login'])->name('user.login.post');
Route::get('register', function () {
    return view('register');
})->name('user.register');
Route::post('register', [HomeController::class, 'register'])->name('user.register.post');
Route::get('about', function () {
    return view('about');
})->name('about');

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
    Route::group(['middleware' => ['auth']], function () {
        Route::resource('products', App\Http\Controllers\ProductController::class);
        Route::resource('product-stock', App\Http\Controllers\ProductStockController::class);
        Route::resource('product-categories', App\Http\Controllers\ProductCategoryController::class);
        Route::resource('users', App\Http\Controllers\UserController::class);
    });
});
