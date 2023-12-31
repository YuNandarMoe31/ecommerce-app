<?php

use App\Http\Controllers\AboutusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\Auth\Admin\LoginController;

// Admin Login
Route::group(['prefix' => 'admin'], function() {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
});

// Admin Dashboard
Route::group(['prefix' => 'admin/', 'middleware' => ['admin']], function () {
    Route::get('/home', [AdminController::class, 'admin'])->name('admin');

    Route::get('/about-us', [AboutusController::class, 'aboutUs'])->name('about.index');
    Route::put('/aboutus-update', [AboutusController::class, 'aboutUpdate'])->name('about.update');

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

    // Product Attribute
    Route::post('product-attribute/{id}', [ProductController::class, 'addProductAttribute'])->name('product.attribute');
    Route::delete('product-attribute-delete/{id}', [ProductController::class, 'deleteProductAttribute'])->name('product.attribute.destroy');

    // User Management
    Route::resource('user', UserController::class);
    Route::post('user_status', [UserController::class, 'userStatus'])->name('user.status');

    // Coupon Management
    Route::resource('coupon', CouponController::class);
    Route::post('coupon_status', [CouponController::class, 'couponStatus'])->name('coupon.status');

    // Shipping Management
    Route::resource('shipping', ShippingController::class);
    Route::post('shipping_status', [ShippingController::class, 'shippingStatus'])->name('shipping.status');

    // Currency Management
    Route::resource('currency', CurrencyController::class);
    Route::post('currency_status', [CurrencyController::class, 'currencyStatus'])->name('currency.status');

    // Order Management
    Route::resource('order', OrderController::class);
    Route::post('order-status/{id}', [OrderController::class, 'orderStatus'])->name('order.status');

    // Setting Management
    Route::get('setting', [SettingController::class, 'setting'])->name('setting');
    Route::put('setting', [SettingController::class, 'settingUpdate'])->name('setting.update');

    // Setting Management
    Route::resource('seller', SellerController::class);
    Route::post('seller-status', [SellerController::class, 'sellerStatus'])->name('seller.status');
    Route::post('seller-verified', [SellerController::class, 'sellerVerified'])->name('seller.verified');

    // SMTP Setting
    Route::get('smtp', [SettingController::class, 'smtp'])->name('smtp');
    Route::put('smtp-update', [SettingController::class, 'smtpUpdate'])->name('smtp.update');
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});