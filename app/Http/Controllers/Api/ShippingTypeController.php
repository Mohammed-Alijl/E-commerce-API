<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ShippingType\DestroyRequest;
use App\Http\Requests\Api\ShippingType\IndexRequest;
use App\Http\Requests\Api\ShippingType\ShowRequest;
use App\Http\Requests\Api\ShippingType\StoreRequest;
use App\Http\Requests\Api\ShippingType\UpdateRequest;

class ShippingTypeController extends Controller
{
    public function index(IndexRequest $request)
    {
        return $request->run();
    }

    public function show(ShowRequest $request, $id)
    {
        return $request->run($id);
    }

    public function store(StoreRequest $request)
    {
        return $request->run();
    }

    public function update(UpdateRequest $request, $id)
    {
        return $request->run($id);
    }

    public function destroy(DestroyRequest $request, $id)
    {
        return $request->run($id);
    }
}
