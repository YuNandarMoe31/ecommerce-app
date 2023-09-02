<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProductReviewController;

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

// Product Review
Route::post('product-review/{slug}', [ProductReviewController::class, 'productReview'])->name('product.review');

// Cart
Route::post('cart/store', [CartController::class, 'cartStore'])->name('cart.store');
Route::post('cart/delete', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::post('cart/update', [CartController::class, 'cartUpdate'])->name('cart.update');

// Coupon
Route::post('coupon/add', [CartController::class, 'couponAdd'])->name('coupon.add');

// Wishlist
Route::get('wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::post('wishlist/store', [WishlistController::class, 'wishlistStore'])->name('wishlist.store');
Route::post('wishlist/move-to-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.move.cart');
Route::post('wishlist/delete', [WishlistController::class, 'wishlistDelete'])->name('wishlist.delete');

// Checkout
Route::get('checkout1', [CheckoutController::class, 'checkout1'])->name('checkout1')->middleware('user');
Route::post('checkout-one', [CheckoutController::class, 'checkoutOneStore'])->name('checkout1.store');
Route::post('checkout-two', [CheckoutController::class, 'checkoutTwoStore'])->name('checkout2.store');
Route::post('checkout-three', [CheckoutController::class, 'checkoutThreeStore'])->name('checkout3.store');
Route::get('checkout-store', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');
Route::get('complete/{id}', [CheckoutController::class, 'complete'])->name('complete');

// Shop
Route::get('shop', [IndexController::class, 'shop'])->name('shop');
Route::post('shop-filter', [IndexController::class, 'shopFilter'])->name('shop.filter');

// Search Product and Autosearch product
Route::get('autosearch', [IndexController::class, 'autosearch'])->name('autosearch');
Route::get('search', [IndexController::class, 'search'])->name('search');
// End Frontend


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
