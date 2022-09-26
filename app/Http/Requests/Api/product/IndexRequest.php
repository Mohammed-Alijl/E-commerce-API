<?php

namespace App\Http\Requests\Api\product;

use App\Http\Resources\Product\IndexResource;
use App\Models\Product;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }

    public function run()
    {
        try {
            return IndexResource::collection(Product::paginate(2));
        } catch (Exception $ex) {
            return $this->apiResponse(null, 500, $ex->getMessage());
        }
    }

    public function rules()
    {
        return [
            //
        ];
    }


}

