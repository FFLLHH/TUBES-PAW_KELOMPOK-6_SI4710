<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\CouponController;

// Group prefix '/admin'
Route::group(['prefix' => 'admin'], function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/file-manager', function () {
        return view('backend.layouts.file-manager');
    })->name('file-manager');

    // User routes
    Route::resource('users', UsersController::class);

    // Banner
    Route::resource('banner', BannerController::class);

    // Brand
    Route::resource('brand', BrandController::class);

    // Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin-profile');
    Route::post('/profile/{id}', [AdminController::class, 'profileUpdate'])->name('profile-update');

    // Category
    Route::resource('category', CategoryController::class);

    // Product
    Route::resource('product', ProductController::class);

    // Ajax untuk sub‐category
    Route::post('/category/{id}/child', [CategoryController::class, 'getChildByParent']);

    // Post Category
    Route::resource('post-category', PostCategoryController::class);

    // Post Tag
    Route::resource('post-tag', PostTagController::class);

    // Post
    Route::resource('post', PostController::class);

    // Message
    Route::resource('message', MessageController::class);
    Route::get('/message/five', [MessageController::class, 'messageFive'])->name('messages.five');

    // Order
    Route::resource('order', OrderController::class);

    // Shipping
    Route::resource('shipping', ShippingController::class);

    // Coupon
    Route::resource('coupon', CouponController::class);

    // Settings
    Route::get('settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('setting/update', [AdminController::class, 'settingsUpdate'])->name('settings.update');

    // Notification
    Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('admin.notification');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('all.notification');
    Route::delete('/notification/{id}', [NotificationController::class, 'delete'])->name('notification.delete');

    // Password Change
    Route::get('change-password', [AdminController::class, 'changePassword'])->name('change.password.form');
    Route::post('change-password', [AdminController::class, 'changePasswordStore'])->name('change.password');
});
