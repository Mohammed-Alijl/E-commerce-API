<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Image\DestroyRequest;
use App\Http\Requests\Api\Image\IndexRequest;
use App\Http\Requests\Api\Image\ShowRequest;
use App\Http\Requests\Api\Image\StoreRequest;

class ImageController extends Controller
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
