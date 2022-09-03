<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserLikeProductController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'CheckPassword'], function () {

    Route::group(['prefix' => 'Auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/getUser', [AuthController::class, 'userProfile']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
    Route::group(['prefix' => 'category'], function () {
        Route::post('/index', [CategoryController::class, 'index']);
        Route::post('/show', [CategoryController::class, 'show']);
        Route::post('/store', [CategoryController::class, 'store']);
        Route::post('/update', [CategoryController::class, 'update']);
        Route::post('/destroy', [CategoryController::class, 'destroy']);
    });
    Route::group(['prefix' => 'product'], function () {
        Route::post('/index', [ProductController::class, 'index']);
        Route::post('show', [ProductController::class, 'show']);
        Route::post('/store', [ProductController::class, 'store']);
        Route::post('/update', [ProductController::class, 'update']);
        Route::post('/destroy', [ProductController::class, 'destroy']);
        Route::group(['prefix' => 'like'], function () {
            Route::post('/index', [UserLikeProductController::class, 'index']);
            Route::post('/show', [UserLikeProductController::class, 'show']);
            Route::post('/store', [UserLikeProductController::class, 'store']);
            Route::post('/destroy', [UserLikeProductController::class, 'destroy']);
        });
        Route::group(['prefix' => 'image'], function () {
            Route::post('/index', [ImageController::class, 'index']);
            Route::post('/show', [ImageController::class, 'show']);
            Route::post('/store', [ImageController::class, 'store']);
            Route::post('/destroy', [ImageController::class, 'destroy']);
        });
        Route::group(['prefix' => 'color'], function () {
            Route::post('/index', [ColorController::class, 'index']);
            Route::post('/show', [ColorController::class, 'show']);
            Route::post('/store', [ColorController::class, 'store']);
            Route::post('/update', [ColorController::class, 'update']);
            Route::post('/destroy', [ColorController::class, 'destroy']);
        });
        Route::group(['prefix' => 'size'], function () {
            Route::post('/index', [SizeController::class, 'index']);
            Route::post('/show', [SizeController::class, 'show']);
            Route::post('/store', [SizeController::class, 'store']);
            Route::post('/update', [SizeController::class, 'update']);
            Route::post('/destroy', [SizeController::class, 'destroy']);
        });

    });
    Route::group(['prefix' => 'order'], function () {
        Route::post('/index', [OrderController::class, 'index']);
        Route::post('/show', [OrderController::class, 'show']);
        Route::post('/store', [OrderController::class, 'store']);
        Route::post('/update', [OrderController::class, 'update']);
        Route::post('/destroy', [OrderController::class, 'destroy']);
        Route::post('/destroy/all', [OrderController::class, 'destroyAll']);
    });

    Route::group(['prefix'=>'user'],function(){
        Route::post('/index', [UserController::class, 'index']);
        Route::post('/show', [UserController::class, 'show']);
        Route::post('/store', [UserController::class, 'store']);
        Route::post('/update', [UserController::class, 'update']);
        Route::post('/destroy', [UserController::class, 'destroy']);

        Route::group(['prefix'=>'address'],function(){
            Route::post('/index', [AddressController::class, 'index']);
            Route::post('/show', [AddressController::class, 'show']);
            Route::post('/store', [AddressController::class, 'store']);
            Route::post('/update', [AddressController::class, 'update']);
            Route::post('/destroy', [AddressController::class, 'destroy']);
        });

    });

});
