<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Frontend

// Authentication
Route::get('user/auth', [IndexController::class, 'userAuth'])->name('user.auth');
Route::post('user/login', [IndexController::class, 'loginSubmit'])->name('login.submit');
Route::post('user/register', [IndexController::class, 'registerSubmit'])->name('register.submit');

Route::get('user/logout', [IndexController::class, 'userlogout'])->name('user.logout');

Route::get('/', [IndexController::class, 'home'])->name('home');

// Product
Route::get('product-category/{slug}/', [IndexController::class, 'productCategory'])->name('product.category');

// Product Detail
Route::get('product-detail/{slug}/', [IndexController::class, 'productDetail'])->name('product.detail');

// Cart
Route::post('cart/store', [CartController::class, 'cartStore'])->name('cart.store');
Route::post('cart/delete', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::post('cart/update', [CartController::class, 'cartUpdate'])->name('cart.update');

// Coupon
Route::post('coupon/add', [CartController::class, 'couponAdd'])->name('coupon.add');

// End Frontend

// Backend
Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Dashboard
Route::group(['prefix' => 'admin/', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/home', [AdminController::class, 'admin'])->name('admin');

    // Banner Management
    Route::resource('banner', BannerController::class);
    Route::post('banner_status', [BannerController::class, 'bannerStatus'])->name('banner.status');

    // Category Management
    Route::resource('category', CategoryController::class);
    Route::post('category_status', [CategoryController::class, 'categoryStatus'])->name('category.status');
    Route::post('category/{id}/child', [CategoryController::class, 'getChildByParentId']);

    // Brand Management
    Route::resource('brand', BrandController::class);
    Route::post('brand_status', [BrandController::class, 'brandStatus'])->name('brand.status');

    // Product Management
    Route::resource('product', ProductController::class);
    Route::post('product_status', [ProductController::class, 'productStatus'])->name('product.status');

    // User Management
    Route::resource('user', UserController::class);
    Route::post('user_status', [UserController::class, 'userStatus'])->name('user.status');

    // Coupon Management
    Route::resource('coupon', CouponController::class);
    Route::post('coupon_status', [CouponController::class, 'couponStatus'])->name('coupon.status');
});

// Seller
Route::group(['prefix' => 'seller', 'middleware' => ['auth', 'seller']], function () {
    Route::get('/', [AdminController::class, 'admin'])->name('seller');
});

// User Dashboard
Route::group(['prefix' => 'user'], function () {
    Route::get('/dashboard', [IndexController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/order', [IndexController::class, 'userOrder'])->name('user.order');
    Route::get('/address', [IndexController::class, 'userAddress'])->name('user.address');
    Route::get('/account-detail', [IndexController::class, 'userAccount'])->name('user.account');

    Route::post('/billing/address/{id}', [IndexController::class, 'billingAddress'])->name('billing.address');
    Route::post('/shipping/address/{id}', [IndexController::class, 'shippingAddress'])->name('shipping.address');

    Route::post('/account/update/{id}', [IndexController::class, 'updateAccount'])->name('account.update');
});
