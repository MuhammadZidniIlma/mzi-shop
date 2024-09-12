<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatusOrderController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminOnlyMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\PegawaiAdminMiddleware;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog-detail/{slug}', [HomeController::class, 'blogDetail'])->name('blog-detail');
Route::post('/blog-detail/{slug}', [HomeController::class, 'comment'])->name('comment');
Route::get('/service', [HomeController::class, 'service'])->name('service');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/card-orders/{slug}', [OrderController::class, 'store'])->name('card-orders');
Route::get('/trolly', [OrderController::class, 'trolly'])->name('trolly');
Route::delete('/delete-item/{id}', [OrderController::class, 'deleteItem'])->name('deleteItem');

Route::get('/check-order-status', [OrderController::class, 'checkOrderStatus'])->name('checkOrderStatus');
Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->name('orders.invoice');

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('user-profile', [HomeController::class, 'profile'])->name('profile.home');
    Route::get('/password-change', [HomeController::class, 'changePassword'])->name('changePasswordHome');

    Route::put('users/profile/{id}', [UserController::class, 'profileUpdate'])->name('profileUpdate');
    Route::put('users/change-password/{id}', [UserController::class, 'changePasswordProcess'])->name('changePasswordProcess');
    Route::put('users/upload-avatar/{id}', [UserController::class, 'uploadAvatar'])->name('uploadAvatar');
    Route::put('users/reset-avatar/{id}', [UserController::class, 'resetAvatar'])->name('resetAvatar');
    Route::put('users/deactive-account/{id}', [UserController::class, 'deactiveAccount'])->name('deactiveAccount');

    Route::get('/shipping-address', [HomeController::class, 'shippingAddress'])->name('shippingAddress');
    Route::put('/shipping-address/{id}', [HomeController::class, 'shippingAddressProcess'])->name('shippingAddressProcess');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/update/', [OrderController::class, 'checkoutUpdate'])->name('checkoutUpdate');
    Route::get('/thank-you', [OrderController::class, 'thankyou'])->name('thankyou');

    Route::post('/apply-discount', [DiscountController::class, 'applyCoupon'])->name('apply.coupon');

});
// Authentication Routes
Route::middleware(GuestMiddleware::class)->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'loginproses'])->name('loginproses');
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register', [LoginController::class, 'registerproses'])->name('registerproses');
});
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::middleware(AuthMiddleware::class, PegawaiAdminMiddleware::class)->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::post('/', [UserController::class, 'store'])->name('user.store')->middleware(AdminOnlyMiddleware::class);
        Route::put('/{id}', [UserController::class, 'update'])->name('user.update')->middleware(AdminOnlyMiddleware::class);
        Route::delete('/{id}', [UserController::class, 'delete'])->name('user.delete')->middleware(AdminOnlyMiddleware::class);
        Route::put('/ban/{id}', [UserController::class, 'banUser'])->name('user.ban')->middleware(AdminOnlyMiddleware::class);
        Route::put('/unban/{id}', [UserController::class, 'unbanUser'])->name('user.unban')->middleware(AdminOnlyMiddleware::class);
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
    });

    // Category Management
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/{slug}', [CategoryController::class, 'update'])->name('category.update')->middleware(AdminOnlyMiddleware::class);
        Route::delete('/{slug}', [CategoryController::class, 'delete'])->name('category.delete')->middleware(AdminOnlyMiddleware::class);
    });

    Route::prefix('discount')->group(function () {
        Route::get('/', [DiscountController::class, 'index'])->name('discount');
        Route::post('/', [DiscountController::class, 'store'])->name('discount.store');
        Route::put('/{id}', [DiscountController::class, 'update'])->name('discount.update');
        Route::delete('/{id}', [DiscountController::class, 'delete'])->name('discount.delete');

        Route::get('/banner', [DiscountController::class, 'banner'])->name('discount.banner');
        Route::put('/banner/{id}', [DiscountController::class, 'bannerUpdate'])->name('discount.banner.update');
        Route::put('/banner-upload/{id}', [DiscountController::class, 'bannerUpload'])->name('discount.banner.upload');
    });

    // Product Management
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('/create', [ProductController::class, 'create'])->name('productscreate');
        Route::post('/', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{slug}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/update/{slug}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/{slug}', [ProductController::class, 'delete'])->name('product.delete');
    });

    // routes/web.php

    Route::prefix('orders')->group(function () {
        Route::get('/', [StatusOrderController::class, 'index'])->name('orders');
        Route::get('/confirmed', [StatusOrderController::class, 'confirmed'])->name('orders.confirmed');
        Route::put('/confirmed/{id}', [StatusOrderController::class, 'confirmOrder'])->name('orders.confirmed.process');
        Route::get('/packed', [StatusOrderController::class, 'packed'])->name('orders.packed');
        Route::put('/packed/{id}', [StatusOrderController::class, 'packOrder'])->name('orders.packed.process');
        Route::get('/shipped', [StatusOrderController::class, 'shipped'])->name('orders.shipped');
        Route::put('/shipped/{id}', [StatusOrderController::class, 'shipOrder'])->name('orders.shipped.process');
        Route::get('/completed', [StatusOrderController::class, 'completed'])->name('orders.completed');
        Route::put('/completed/{id}', [StatusOrderController::class, 'completeOrder'])->name('orders.completed.process');
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts');
        Route::get('/create', [PostController::class, 'create'])->name('postscreate');
        Route::post('/', [PostController::class, 'store'])->name('post.store');
        Route::get('/edit/{slug}', [PostController::class, 'edit'])->name('post.edit');
        Route::put('/update/{slug}', [PostController::class, 'update'])->name('post.update');
        Route::delete('/{slug}', [PostController::class, 'delete'])->name('post.delete');
    });
});
