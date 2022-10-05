<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Order;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProcessOrderRequest extends FormRequest
{
    use Api_Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard');
    }

    public function run()
    {
        $order = Order::find($this->order_id);
        if (!$order)
            return $this->apiResponse(null, 404, __('messages.order.found'));
        if ($order->status_id != 1)
            switch ($order->status_id) {
                case 2 :
                    return $this->apiResponse(null, 422, __('messages.order.shipping'));
                case 3 :
                    return $this->apiResponse(null, 422, __('messages.order.shipped'));
                case 4 :
                    return $this->apiResponse(null, 422, __('messages.order.rejected'));
            }
        if ($this->accept) {
            $order->status_id = 2;
            $order->save();
            return $this->apiResponse(null, 200, __('messages.order.transfer.shipping'));
        }
        if (!$this->accept) {
            $order->status_id = 4;
            $order->save();
            return $this->apiResponse(null, 200, __('messages.order.transfer.reject'));
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
            'order_id' => 'required|numeric|exists:orders,id',
            'accept' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return[
          'order_id.required'=>__('messages.order.order_id.required'),
          'order_id.numeric'=>__('messages.order.order_id.numeric'),
          'order_id.exists'=>__('messages.order.order_id.exists'),
          'accept.required'=>__('messages.order.accept.required'),
          'accept.boolean'=>__('messages.order.accept.boolean'),
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
