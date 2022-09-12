<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\product\DestroyRequest;
use App\Http\Requests\Api\product\IndexRequest;
use App\Http\Requests\Api\product\ShowRequest;
use App\Http\Requests\Api\product\StoreRequest;
use App\Http\Requests\Api\product\UpdateRequest;

class ProductController extends Controller
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
