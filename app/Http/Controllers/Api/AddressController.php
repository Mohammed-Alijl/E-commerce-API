<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Address\DestroyRequest;
use App\Http\Requests\Api\Address\GetDefaultRequest;
use App\Http\Requests\Api\Address\IndexRequest;
use App\Http\Requests\Api\Address\SetDefaultRequest;
use App\Http\Requests\Api\Address\ShowRequest;
use App\Http\Requests\Api\Address\StoreRequest;
use App\Http\Requests\Api\Address\UpdateRequest;

class AddressController extends Controller
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

    public function setDefault(SetDefaultRequest $request)
    {
        return $request->run();
    }

    public function getDefault(GetDefaultRequest $request)
    {
        return $request->run();
    }

}
