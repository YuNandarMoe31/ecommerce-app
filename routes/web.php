<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CurrencyController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/frontend.php';
require __DIR__ . '/backend.php';

Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Seller
Route::group(['prefix' => 'seller', 'middleware' => ['auth', 'seller']], function () {
    Route::get('/', [AdminController::class, 'admin'])->name('seller');
});

Route::post('currency_load', [CurrencyController::class, 'currencyLoad'])->name('currency.load');

