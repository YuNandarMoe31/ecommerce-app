<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Auth\Seller\AuthController;


Route::group(['prefix' => 'seller'], function() {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('seller.login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('seller.login');
});


// Seller Dashboard
Route::group(['prefix' => 'seller/', 'middleware' => ['seller']], function () {
    Route::get('/', [SellerController::class, 'dashboard'])->name('seller');

    // Product Management
    Route::resource('seller-product', ProductController::class);
    Route::post('seller-product_status', [ProductController::class, 'productStatus'])->name('seller.product.status');
    
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});