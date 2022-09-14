<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

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
        return auth('customer')->check();
    }

    public function run()
    {
        try {
            $order = new Order();
            $order->user_id = auth('customer')->id();
            $order->product_id = $this->product_id;
            $order->color_id = $this->color_id;
            $order->size_id = $this->size_id;
            $order->quantity = $this->quantity;
            $order->address = $this->address;
            $order->status = $this->status;
            if ($order->save())
                return $this->apiResponse(new OrderResource($order), 201, 'The order created was success');
            return $this->apiResponse(null, 400, 'The order created was failed');
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
            'product_id' => 'required|numeric|exists:products,id',
            'color_id' => 'required|numeric|exists:colors,id',
            'size_id' => 'required|numeric|exists:sizes,id',
            'address' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'status' => 'required|max:255',
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
