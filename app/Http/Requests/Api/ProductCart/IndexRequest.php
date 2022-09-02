<?php

namespace App\Http\Requests\Api\ProductCart;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ProductCartResource;
use App\Models\Cart;
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
            $cart = Cart::find($this->cart_id);
            if(!$cart)
                return $this->apiResponse(null,404,'The cart is not exist');
            return $this->apiResponse(ProductCartResource::collection($cart->productCart),200,'This is the cart content');
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
