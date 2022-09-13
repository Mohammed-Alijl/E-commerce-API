<?php

namespace App\Http\Requests\Api\product;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\Product\IndexResource;
use App\Models\Product;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    use Api_Response;

    public function authorize()
    {
        return true;
    }

    public function run()
    {
        try {
            return $this->apiResponse(IndexResource::collection(Product::get()), 200, 'This is all products in the category');
        } catch (Exception $ex) {
            return $this->apiResponse(null, 400, $ex->getMessage());
        }
    }

    public function rules()
    {
        return [
            //
        ];
    }


}

