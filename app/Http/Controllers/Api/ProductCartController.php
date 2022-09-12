<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductCart\DestroyRequest;
use App\Http\Requests\Api\ProductCart\IndexRequest;
use App\Http\Requests\Api\ProductCart\ShowRequest;
use App\Http\Requests\Api\ProductCart\StoreRequest;
use App\Http\Requests\Api\ProductCart\UpdateRequest;

class ProductCartController extends Controller
{
    public function index(IndexRequest $request){
        return $request->run();
    }
    public function show(ShowRequest $request){
        return $request->run();
    }

    public function store(StoreRequest $request){
        return $request->run();
    }
    public function update(UpdateRequest $request){
        return $request->run();
    }
    public function destroy(DestroyRequest $request){
        return $request->run();
    }

}