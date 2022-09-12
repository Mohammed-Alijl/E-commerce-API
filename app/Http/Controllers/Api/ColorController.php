<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Color\Admin\DestroyRequest;
use App\Http\Requests\Api\Color\Admin\IndexRequest;
use App\Http\Requests\Api\Color\Admin\StoreRequest;
use App\Http\Requests\Api\Color\Admin\UpdateRequest;
use App\Http\Requests\Api\Color\ShowRequest;

class ColorController extends Controller
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
