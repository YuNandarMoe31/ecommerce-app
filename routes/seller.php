<?php

use App\Http\Controllers\Auth\Seller\AuthController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'seller'], function() {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('seller.login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('seller.login');
});


// Admin Dashboard
Route::group(['prefix' => 'seller/', 'middleware' => ['seller']], function () {
    Route::get('/', [SellerController::class, 'dashboard'])->name('seller');
});