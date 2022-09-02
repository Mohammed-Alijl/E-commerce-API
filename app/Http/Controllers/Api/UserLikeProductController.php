<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User_like_product\DestroyRequest;
use App\Http\Requests\Api\User_like_product\IndexRequest;
use App\Http\Requests\Api\User_like_product\ShowRequest;
use App\Http\Requests\Api\User_like_product\StoreRequest;

class UserLikeProductController extends Controller
{
    public function index(IndexRequest $request){
        return $request->run();
    }
    public function store(StoreRequest $request){
        return $request->run();
    }
    public function show(ShowRequest $request){
        return $request->run();
    }
    public function destroy(DestroyRequest $request){
        return $request->run();
    }
}
