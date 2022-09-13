<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\DestroyRequest;
use App\Http\Requests\Api\Order\IndexRequest;
use App\Http\Requests\Api\Order\ShowRequest;
use App\Http\Requests\Api\Order\StoreRequest;
use App\Http\Requests\Api\Order\UpdateRequest;

class OrderController extends Controller
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

    public function update(UpdateRequest $request)
    {
        return $request->run();
    }

    public function destroy(DestroyRequest $request)
    {
        return $request->run();
    }

}
