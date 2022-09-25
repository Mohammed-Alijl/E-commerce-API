<?php

namespace App\Http\Requests\Api\product;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\Product\IndexResource;
use App\Models\Image;
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
//            return $this->apiResponse(Product::select('id','name','price')->with(['images'=>function($q){
//                $q->select('product_id','image');
//            }])->paginate(2), 200, 'This is all products in the category');
            $products = IndexResource::collection(Product::paginate(2));
            return $this->apiResponse($products,200,'This is all products in the category');
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

