<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ShippingType\DestroyRequest;
use App\Http\Requests\Api\ShippingType\IndexRequest;
use App\Http\Requests\Api\ShippingType\ShowRequest;
use App\Http\Requests\Api\ShippingType\StoreRequest;
use App\Http\Requests\Api\ShippingType\UpdateRequest;
use Illuminate\Http\Request;

class ShippingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        return $request->run();
    }


    public function store(StoreRequest $request)
    {
        return $request->run();
    }


    public function show(ShowRequest $request, $id)
    {
        return $request->run($id);
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
