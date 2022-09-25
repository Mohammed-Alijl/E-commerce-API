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

    public function run(){
        $order = Order::find($this->order_id);
        if(!$order)
            return $this->apiResponse(null,404,'This order is not exist');
        if($order->status_id != 1)
            switch ($order->status_id){
                case 2 : return $this->apiResponse(null,422,'This order is already in shipping stage');
                case 3 : return $this->apiResponse(null,422,'This order has already been shipped');
                case 4 : return $this->apiResponse(null,422,'This order is already reject before');
            }
        if($this->accept == true || $this->accept == 1 ){
            $order->status_id = 2;
            $order->save();
            return $this->apiResponse(null,200,'The order has been successfully transferred to the shipping stage');
        }
        if ($this->accept == false || $this->accept == 0 ) {
            $order->status_id = 4;
            $order->save();
            return $this->apiResponse(null, 200, 'The order was rejected');
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
            'order_id'=>'required|numeric|exists:orders,id',
            'accept'=>'required|boolean'
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
