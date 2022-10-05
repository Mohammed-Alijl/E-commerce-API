<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\OrderResource;
use App\Models\Order;
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
        return auth('customer')->check() && auth('customer')->user()->tokenCan('customer') || auth('dashboard')->check();
    }

    public function run($id)
    {
        try {
            $order = Order::find($id);
            if (!$order)
                return $this->apiResponse(null, 404, __('messages.order.found'));
            if (auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard'))
                return $this->dashboardRun($id);
            else
                return $this->customerRun($id);
        } catch (Exception $ex) {
            return $this->apiResponse(null, 500, $ex->getMessage());
        }
    }

    private function dashboardRun($id)
    {
        $order = Order::find($id);
        $order->status_id = $this->status_id;
        if ($order->save())
            return $this->apiResponse(new OrderResource($order), 200, __('messages.order.update'));
        return $this->apiResponse(null, 200, __('messages.failed'));
    }

    private function customerRun($id)
    {
        $order = Order::find($id);
        if ($this->filled('color_id'))
            $order->color_id = $this->color_id;
        if ($this->filled('size_id'))
            $order->size_id = $this->size_id;
        if ($this->filled('address_id'))
            $order->address_id = $this->address_id;
        if ($this->filled('shippingType_id'))
            $order->shippingType_id = $this->shippingType_id;
        if ($this->filled('quantity')) {
            if($this->quantity > Product::find($order->product_id)->quantity)
                return $this->apiResponse(null,422,'This quantity is not available right now');
            $product = Product::find($order->product_id);
            $product->quantity =+ $order->quantity;
            $product->save();
            $product->quantity =- $this->quantity;
            $product->save();
            $order->quantity = $this->quantity;
        }
        if ($order->save())
            return $this->apiResponse(new OrderResource($order), 200, 'The order updated was success');
        return $this->apiResponse(null, 200, 'The order updated was failed');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (auth('customer')->check() && auth('customer')->user()->tokenCan('customer'))
            return [
                'color_id' => 'numeric|exists:colors,id',
                'size_id' => 'numeric|exists:sizes,id',
                'address_id' => 'numeric|exists:addresses,id',
                'shippingType_id' => 'numeric|exists:shipping_types,id',
                'quantity' => "numeric|min:1|",

            ];
        if (auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard'))
            return [
                'status_id' => 'required|numeric|exists:statuses,id'
            ];
    }

    public function messages()
    {
        return[
          'color_id.numeric'=>__('messages.order.color_id.numeric'),
          'color_id.exists'=>__('messages.order.color_id.exists'),
          'size_id.numeric'=>__('messages.order.size_id.numeric'),
          'size_id.exists'=>__('messages.order.size_id.exists'),
          'address_id.numeric'=>__('messages.order.address_id.numeric'),
          'address_id.exists'=>__('messages.order.address_id.exists'),
          'shippingType_id.numeric'=>__('messages.order.shippingType_id.numeric'),
          'shippingType_id.exists'=>__('messages.order.shippingType_id.exists'),
          'quantity.numeric'=>__('messages.order.quantity.numeric'),
          'quantity.min'=>__('messages.order.quantity.min'),
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
