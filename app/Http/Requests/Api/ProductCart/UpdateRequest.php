<?php

namespace App\Http\Requests\Api\ProductCart;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ProductCartResource;
use App\Models\ProductCart;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

class UpdateRequest extends FormRequest
{
    use Api_Response;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('customer')->check();
    }

    public function run(){
        try {
            $product = ProductCart::find($this->id);
            if($this->filled('product_id'))
                $product->product_id = $this->product_id;
            if($this->filled('color_id'))
                $product->color_id = $this->color_id;
            if($this->filled('size_id'))
                $product->size_id = $this->size_id;
            if($this->filled('quantity'))
                $product->quantity = $this->quantity;
            if($product->save())
                return $this->apiResponse(new ProductCartResource($product),200,'The product in cart has been updated');
            return $this->apiResponse(null,400,'The product in cart has not been updated, please try again');
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
            'product_id'=>'numeric|exists:products,id',
            'color_id'=>'numeric|exists:colors,id',
            'size_id'=>'numeric|exists:sizes,id',
            'quantity'=>'numeric',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null,422,$validator->errors()));
    }
    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null,401,'you are not authorize'));
    }
}
