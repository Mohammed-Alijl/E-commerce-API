<?php

namespace App\Http\Requests\Api\Size;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\SizeResource;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use mysql_xdevapi\Exception;

class IndexRequest extends FormRequest
{
    use Api_Response;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function run(){
        try {
            $product = Product::find($this->product_id);
            if(!$product)
                return $this->apiResponse(null,404,'The product is not exist');
            return $this->apiResponse(SizeResource::collection($product->sizes),200,'This is all sizes for this product');
        }catch (Exception $ex){
            return $this->apiResponse(null,400,$ex->getMessage());
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
