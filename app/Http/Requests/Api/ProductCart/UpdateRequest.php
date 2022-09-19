<?php

namespace App\Http\Requests\Api\ProductCart;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
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
        return auth('customer')->check() && auth('customer')->user()->tokenCan('user');
    }

    public function run()
    {
        try {
            $cartItem = CartItem::find($this->id);
            if(!$cartItem)
                return $this->apiResponse(null,404,'The item is not exist');
            if ($this->filled('product_id'))
                $cartItem->product_id = $this->product_id;
            if ($this->filled('color_id'))
                $cartItem->color_id = $this->color_id;
            if ($this->filled('size_id'))
                $cartItem->size_id = $this->size_id;
            if ($this->filled('quantity'))
                $cartItem->quantity = $this->quantity;
            if ($cartItem->save())
                return $this->apiResponse(new CartItemResource($cartItem), 200, 'The cart item has been updated');
            return $this->apiResponse(null, 400, 'The cart item was not updated, please try again');
        } catch (Exception $ex) {
            return $this->apiResponse(null, 400, $ex->getMessage());
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
            'product_id' => 'numeric|exists:products,id',
            'color_id' => 'numeric|exists:colors,id',
            'size_id' => 'nullable|numeric|exists:sizes,id',
            'quantity' => 'numeric',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, 'you are not authorize'));
    }
}
