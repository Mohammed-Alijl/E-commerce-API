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

class StoreRequest extends FormRequest
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

    public function run()
    {
        try {
            if ($items = CartItem::where('product_id', $this->product_id)->get()) {
                $result = 0;
                foreach ($items as $item)
                    $result += $item->quantity;
                $result += $this->quantity;
                if ($result > Product::find($this->product_id)->quantity)
                    return $this->apiResponse(null, 422, 'This quantity not available right now');
            }
            $cartItem = new CartItem();
            $cartItem->cart_id = auth('customer')->id();
            $cartItem->product_id = $this->product_id;
            $cartItem->color_id = $this->color_id;
            if ($this->filled('size_id'))
                $cartItem->size_id = $this->size_id;
            $cartItem->quantity = $this->quantity;
            if ($cartItem->save())
                return $this->apiResponse(new CartItemResource($cartItem), 201, 'Item add to cart successfully');
            return $this->apiResponse(new CartItemResource($cartItem), 500, 'Item add to cart failed, please try again');
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
            'product_id' => 'required|numeric|exists:products,id',
            'color_id' => 'required|numeric|exists:colors,id',
            'size_id' => 'nullable|numeric|exists:sizes,id',
            'quantity' => 'required|numeric|min:1|max:' . Product::find($this->product_id)->quantity,
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
