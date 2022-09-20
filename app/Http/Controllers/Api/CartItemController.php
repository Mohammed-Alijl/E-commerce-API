<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CartItem\DestroyRequest;
use App\Http\Requests\Api\CartItem\IndexRequest;
use App\Http\Requests\Api\CartItem\ShowRequest;
use App\Http\Requests\Api\CartItem\CheckoutRequest;
use App\Http\Requests\Api\CartItem\StoreRequest;
use App\Http\Requests\Api\CartItem\UpdateRequest;

class CartItemController extends Controller
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

    public function checkout(CheckoutRequest $request){
        return $request->run();
    }

}
