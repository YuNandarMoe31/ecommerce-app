<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Dashboard
Route::group(['prefix'=>'admin/', 'middleware'=>'auth'], function() {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');

    // Banner Management
    Route::resource('banner', BannerController::class);
    Route::post('banner_status', [BannerController::class, 'bannerStatus'])->name('banner.status');
});


