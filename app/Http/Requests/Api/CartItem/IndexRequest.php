<?php

namespace App\Http\Requests\Api\CartItem;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\CartItemResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

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
        return auth('customer')->check() && auth('customer')->user()->tokenCan('customer');
    }

    public function run()
    {
        try {
            $cartItems = auth('customer')->user()->cart->cartItems;
            return $this->apiResponse(CartItemResource::collection($cartItems), 200, 'This is all items in the cart');
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
            //
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, 'This action is unauthorized'));
    }
}
