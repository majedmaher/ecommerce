<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UIController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('language', [LanguageController::class, 'ChangeLanguage'])->name('change.language');


Route::controller(FrontController::class)->group(function () {
    Route::post('subscribe', 'subscribe')->name('subscribe.store');
    Route::post('contact', 'contact')->name('contact.store');
    Route::post('newsletter', 'newsletter')->name('newsletter.store');
});

Route::controller(UIController::class)->group(function () {
    // Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/cart', 'cart')->name('cart');
    Route::get('/checkout', 'checkout')->name('checkout');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('product/details/{product_slug}', 'detail')->name('details');
    Route::get('/shop', 'shop')->name('shop');

    // get product in category
    Route::get('category/{category_slug}/products', 'CategoryProducts')->name('category.products');
    Route::get('sub-category/{sub_category_slug}/get/products', [UIController::class, 'SubCategoryProducts'])->name('sub.category.products');
    // });
});

Route::group(['middleware' => 'guest', 'prefix' => 'admin'], function () {
    Route::controller(RegisterController::class)->group(function () {

        Route::get('register', 'register')->name('register');
        Route::post('register', 'store')->name('register.store');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('login', 'store')->name('login.store');
    });

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('forget-password', 'getEmail');
        Route::post('forget-password', 'postEmail');
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('reset-password/{token}', 'getPassword');
        Route::post('reset-password', 'updatePassword');
    });
});
Route::middleware(['admin'])->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('logout', 'logout')->name('logout');
        Route::get('home', 'home')->name('home');
    });
});

Route::get('account/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify');

// Admin cpanel
Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'is_verify_email']], function () {
    Route::group(['prefix' => 'category', 'controller' => CategoryController::class], function () {
        Route::get('/', 'index')->name('categories');
        Route::get('create', 'create')->name('category.create');
        Route::post('create', 'store')->name('category.store');
        Route::get('edit/{id}', 'edit')->name('category.edit');
        Route::post('update', 'update')->name('category.update');
        Route::get('destroy/{id}', 'destroy')->name('category.destroy');
    });

    Route::group(['prefix' => 'sub/category', 'controller' => SubCategoryController::class], function () {
        Route::get('/', 'index')->name('sub_categories');
        Route::get('create', 'create')->name('sub_category.create');
        Route::post('create', 'store')->name('sub_category.store');
        Route::get('edit/{id}', 'edit')->name('sub_category.edit');
        Route::post('update', 'update')->name('sub_category.update');
        Route::get('destroy/{id}', 'destroy')->name('sub_category.destroy');
    });

    Route::group(['prefix' => 'product', 'controller' => ProductController::class], function () {
        Route::get('/', 'index')->name('products');
        Route::get('create', 'create')->name('product.create');
        Route::post('create', 'store')->name('product.store');
        Route::get('edit/{id}', 'edit')->name('product.edit');
        Route::post('update', 'update')->name('product.update');
        Route::post('new-muliimg', 'NewMuliImg')->name('product.new.muliimg');
        Route::post('multi-image/update', 'MultiImageUpdate')->name('product.multiimg.update');
        Route::get('multi-image/{id}', 'MultiImageDelete')->name('product.multiimg.delete');
        Route::get('destroy/{id}', 'destroy')->name('product.destroy');
    });

    Route::group(['prefix' => 'coupon', 'controller' => CouponController::class], function () {
        Route::get('/', 'index')->name('coupons');
        Route::get('create', 'create')->name('coupon.create');
        Route::post('create', 'store')->name('coupon.store');
        Route::get('edit/{id}', 'edit')->name('coupon.edit');
        Route::post('update/{id}', 'update')->name('coupon.update');
        Route::get('destroy/{id}', 'destroy')->name('coupon.destroy');
    });

    Route::group(['prefix' => 'vendor', 'controller' => VendorController::class], function () {
        Route::get('/', 'index')->name('vendors');
        Route::get('create', 'create')->name('vendor.create');
        Route::post('create', 'store')->name('vendor.store');
        Route::get('edit/{id}', 'edit')->name('vendor.edit');
        Route::post('update', 'update')->name('vendor.update');
        Route::get('destroy/{id}', 'destroy')->name('vendor.destroy');
    });


    Route::group(['prefix' => 'orders', 'as' => 'order.', 'controller' => OrderController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/details/{id}', 'detailsOrder')->name('detais');
    });
});

Route::group(['prefix' => 'cart', 'controller' => CartController::class], function () {
    Route::post('add', 'AddToCart')->name('add.to.cart');
    Route::post('update', 'updateToCart')->name('update.to.cart');
    Route::get('getCount', 'refreshCount')->name('refresh.count');
    Route::post('remove', 'removeCart')->name('remove.cart');
    Route::get('get/total', 'getTotal')->name('get.total');
});

Route::group(['prefix' => 'coupon', 'controller' => CouponController::class], function () {
    Route::post('apply', 'CouponApply')->name('apply.coupon');
    Route::get('remove', 'CouponRemove')->name('remove.coupon');
});

Route::group(['prefix' => 'payment-stripe', 'controller' => PaymentController::class], function () {
    Route::post('/', 'StripeOrder')->name('stripe.order');
    Route::post('/pay', 'StripePost')->name('stripe.payment');
});


Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
