<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use mysql_xdevapi\Exception;

class DestroyRequest extends FormRequest
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
            $order = Order::find($this->order_id);
            if(!$order)
                return $this->apiResponse(null,404,'The order is not exist');
            if($order->delete())
                return $this->apiResponse(null,200,'The order deleted was success');
            return $this->apiResponse(null,400,'The order deleted was failed, please try again');
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
