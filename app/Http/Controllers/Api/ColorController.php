<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Color\DestroyRequest;
use App\Http\Requests\Api\Color\IndexRequest;
use App\Http\Requests\Api\Color\ShowRequest;
use App\Http\Requests\Api\Color\StoreRequest;
use App\Http\Requests\Api\Color\UpdateRequest;

class ColorController extends Controller
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
