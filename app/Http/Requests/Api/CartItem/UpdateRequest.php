<?php

namespace App\Http\Requests\Api\CartItem;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

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
        return auth('customer')->check() && auth('customer')->user()->tokenCan('customer');
    }

    public function run($id)
    {
        try {
            $cartItem = CartItem::find($id);
            if (!$cartItem)
                return $this->apiResponse(null, 404, __('messages.cartItem.found'));
            if ($this->filled('color_id'))
                $cartItem->color_id = $this->color_id;
            if ($this->filled('size_id'))
                $cartItem->size_id = $this->size_id;
            if ($this->filled('quantity')) {
                if ($this->quantity > Product::find($cartItem->product_id)->quantity)
                    return $this->apiResponse(null, 422, __('messages.quantity.max'));
                $cartItem->quantity = $this->quantity;
            }
            if ($cartItem->save())
                return $this->apiResponse(new CartItemResource($cartItem), 200, __('messages.cartItem.update'));
            return $this->apiResponse(null, 500, __('messages.failed'));
        } catch (Exception $ex) {
            return $this->apiResponse(null, 500, $ex->getMessage());
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
            'color_id' => 'numeric|exists:colors,id',
            'size_id' => 'nullable|numeric|exists:sizes,id',
            'quantity' => "numeric|min:1",
        ];
    }

    public function messages()
    {
        return [
            'color_id.numeric' => __('messages.cartItem.color_id.numeric'),
            'color_id.exists' => __('messages.cartItem.color_id.exists'),
            'size_id.numeric' => __('messages.cartItem.size_id.numeric'),
            'size_id.exists' => __('messages.cartItem.size_id.exists'),
            'quantity.numeric' => __('messages.cartItem.quantity.numeric'),
            'quantity.min' => __('messages.cartItem.quantity.min'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
