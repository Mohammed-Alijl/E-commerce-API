<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthDashboardController;
use App\Http\Controllers\Api\AuthUserController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CartItemController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserLikeProductController;
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


Route::group(['prefix' => 'Auth'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('/login', [AuthUserController::class, 'login']);
        Route::post('/register', [AuthUserController::class, 'register']);
        Route::get('/profile', [AuthUserController::class, 'userProfile']);
        Route::post('/logout', [AuthUserController::class, 'logout']);
        Route::post('/email', [AuthUserController::class, 'isEmailUsed']);
    });
    Route::group(['prefix' => 'dashboard'], function () {
        Route::post('/login', [AuthDashboardController::class, 'login']);
        Route::post('/register', [AuthDashboardController::class, 'register']);
        Route::post('/logout', [AuthDashboardController::class, 'logout']);
    });

});
Route::group(['prefix' => 'category'], function () {
    Route::get('/index', [CategoryController::class, 'index']);
    Route::get('/show/{id}', [CategoryController::class, 'show']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::put('/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/destroy/{id}', [CategoryController::class, 'destroy']);
});
Route::group(['prefix' => 'product'], function () {
    Route::get('/index', [ProductController::class, 'index']);
    Route::get('show/{id}', [ProductController::class, 'show']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::put('/update/{id}', [ProductController::class, 'update']);
    Route::delete('/destroy/{id}', [ProductController::class, 'destroy']);
    Route::post('/search', [ProductController::class, 'search']);
    Route::group(['prefix' => 'like'], function () {
        Route::get('/index', [UserLikeProductController::class, 'index']);
        Route::get('/show/{product_id}', [UserLikeProductController::class, 'show']);
        Route::post('/store', [UserLikeProductController::class, 'store']);
        Route::delete('/destroy/{product_id}', [UserLikeProductController::class, 'destroy']);
    });
    Route::group(['prefix' => 'image'], function () {
        Route::get('/index/{product_id}', [ImageController::class, 'index']);
        Route::get('/show/{id}', [ImageController::class, 'show']);
        Route::post('/store', [ImageController::class, 'store']);
        Route::delete('/destroy/{id}', [ImageController::class, 'destroy']);
    });
    Route::group(['prefix' => 'color'], function () {
        Route::get('/index', [ColorController::class, 'index']);
        Route::get('/show/{id}', [ColorController::class, 'show']);
        Route::post('/store', [ColorController::class, 'store']);
        Route::put('/update/{id}', [ColorController::class, 'update']);
        Route::delete('/destroy/{id}', [ColorController::class, 'destroy']);
    });
    Route::group(['prefix' => 'size'], function () {
        Route::get('/index', [SizeController::class, 'index']);
        Route::get('/show/{id}', [SizeController::class, 'show']);
        Route::post('/store', [SizeController::class, 'store']);
        Route::put('/update/{id}', [SizeController::class, 'update']);
        Route::delete('/destroy/{id}', [SizeController::class, 'destroy']);
    });

});
Route::group(['prefix' => 'order'], function () {
    Route::get('/index', [OrderController::class, 'index']);
    Route::get('/show/{id}', [OrderController::class, 'show']);
    Route::post('/store', [OrderController::class, 'store']);
    Route::put('/update/{id}', [OrderController::class, 'update']);
    Route::delete('/destroy/{id}', [OrderController::class, 'destroy']);
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/index', [UserController::class, 'index']);
    Route::get('/show/{id}', [UserController::class, 'show']);
    Route::post('/store', [UserController::class, 'store']);
    Route::put('/update', [UserController::class, 'update']);
    Route::delete('/destroy/{id}', [UserController::class, 'destroy']);
    Route::delete('/destroy', [UserController::class, 'destroy']);

    Route::group(['prefix' => 'address'], function () {
        Route::get('/index', [AddressController::class, 'index']);
        Route::get('/show/{id}', [AddressController::class, 'show']);
        Route::post('/store', [AddressController::class, 'store']);
        Route::put('/update/{id}', [AddressController::class, 'update']);
        Route::delete('/destroy/{id}', [AddressController::class, 'destroy']);
        Route::get('/default', [AddressController::class, 'getDefault']);
        Route::post('/default/set', [AddressController::class, 'setDefault']);
    });

});

Route::group(['prefix' => 'cart'], function () {
    Route::group(['prefix' => 'product'], function () {
        Route::get('/index', [CartItemController::class, 'index']);
        Route::get('/show/{id}', [CartItemController::class, 'show']);
        Route::post('/store', [CartItemController::class, 'store']);
        Route::put('/update/{id}', [CartItemController::class, 'update']);
        Route::delete('/destroy/{id}', [CartItemController::class, 'destroy']);
    });

});

