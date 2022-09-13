<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LikeProduct\DestroyRequest;
use App\Http\Requests\Api\LikeProduct\IndexRequest;
use App\Http\Requests\Api\LikeProduct\ShowRequest;
use App\Http\Requests\Api\LikeProduct\StoreRequest;

class UserLikeProductController extends Controller
{
    public function index(IndexRequest $request)
    {
        return $request->run();
    }

    public function show(ShowRequest $request)
    {
        return $request->run();
    }

    public function store(StoreRequest $request)
    {
        return $request->run();
    }

    public function destroy(DestroyRequest $request)
    {
        return $request->run();
    }
}
