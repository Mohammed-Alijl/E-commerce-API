<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthDashboardController;
use App\Http\Controllers\Api\AuthCustomerController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\ForgetPasswordController;
use App\Http\Controllers\Api\GoogleAuthController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CartItemController;
use App\Http\Controllers\Api\ShippingTypeController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'auth'], function () {
    Route::group(['prefix' => 'customer'], function () {
        Route::post('/login', [AuthCustomerController::class, 'login']);
        Route::post('/register', [AuthCustomerController::class, 'register']);
        Route::get('/profile', [AuthCustomerController::class, 'customerProfile']);
        Route::post('/logout', [AuthCustomerController::class, 'logout']);
        Route::post('/email', [AuthCustomerController::class, 'isEmailUsed']);
        Route::post('/password/code/send', [ForgetPasswordController::class, 'sendCode']);
        Route::post('/password/code/check', [ForgetPasswordController::class, 'checkCode']);
        Route::post('/password/reset', [ForgetPasswordController::class, 'resetPassword']);
        Route::get('google', [GoogleAuthController::class, 'redirectToGoogle'])->middleware('web');
        Route::get('google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->middleware('web');
    });
    Route::group(['prefix' => 'dashboard'], function () {
        Route::post('/login', [AuthDashboardController::class, 'login']);
        Route::post('/register', [AuthDashboardController::class, 'register']);
        Route::post('/logout', [AuthDashboardController::class, 'logout']);
    });
});

Route::group(['prefix' => 'order'], function () {
    Route::get('complete', [OrderController::class, 'getCompleteOrders']);
    Route::post('process', [OrderController::class, 'processOrder']);
});

Route::group(['prefix' => 'customer'], function () {
    Route::put('update', [CustomerController::class, 'update']);
    Route::delete('destroy', [CustomerController::class, 'destroy']);
});

Route::group(['prefix' => 'shipping/address'], function () {
    Route::get('/default', [AddressController::class, 'getDefault']);
    Route::post('/default/set', [AddressController::class, 'setDefault']);
});

Route::post('product/search', [ProductController::class, 'search']);

Route::post('cart/item/checkout', [CartItemController::class, 'checkout']);

Route::get('products/category/{id}', [CategoryController::class, 'getProducts']);

Route::resource('customer', CustomerController::class)->except(['create', 'edit', 'update']);
Route::resource('product/like', LikeController::class)->except(['create', 'edit', 'update']);
Route::resource('product/image', ImageController::class)->except(['create', 'edit', 'update']);
Route::resources(['category' => CategoryController::class, 'product/color' => ColorController::class, 'product/size' => SizeController::class, 'product' => ProductController::class, 'order' => OrderController::class, 'shipping/address' => AddressController::class, 'shipping/type' => ShippingTypeController::class, 'cart/item' => CartItemController::class], ['except' => ['create', 'edit']]);
