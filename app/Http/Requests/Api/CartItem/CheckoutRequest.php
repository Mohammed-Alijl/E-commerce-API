<?php

namespace App\Http\Requests\Api\CartItem;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

class CheckoutRequest extends FormRequest
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
            $items = auth('customer')->user()->cart->cartItems;
            if(count($items)<1)
                return $this->apiResponse(['success'=>false],422,'Your cart is empty');
            foreach ($items as $item){
                $order = new Order();
                $order->user_id = auth('customer')->id();
                $order->product_id = $item->product_id;
                $order->color_id = $item->color_id;
                $order->size_id = $item->size_id;
                $order->address_id = $this->address_id;
                $order->quantity = $item->quantity;
                $order->status_id = 1;
                if($order->save()){
                    $product = Product::find($item->product_id);
                    $product->quantity -= $item->quantity;
                    $product->save();
                    $item->delete();
                }
            }
            return $this->apiResponse(['success'=>true],200,'checkout was successes');
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
            'address_id'=>'required|numeric|exists:addresses,id'
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
