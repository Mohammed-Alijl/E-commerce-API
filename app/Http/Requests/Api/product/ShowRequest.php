<?php

namespace App\Http\Requests\Api\product;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use mysql_xdevapi\Exception;

class ShowRequest extends FormRequest
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
    public function run(){
        try {
            $product = Product::find($this->product_id);
            if(!$product)
                return $this->apiResponse(null,404,'The product was not found');
            return $this->apiResponse(new ProductResource($product),200,'This is the product');
        }catch (Exception $ex){
            return $this->apiResponse(null,400,$ex->getMessage());
        }
    }
}
