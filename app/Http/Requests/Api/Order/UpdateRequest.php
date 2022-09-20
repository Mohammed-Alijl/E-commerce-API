<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\OrderResource;
use App\Models\Order;
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
        return auth('customer')->check() && auth('customer')->user()->tokenCan('user') || auth('dashboard')->check();
    }

    public function run()
    {
        try {
            $order = Order::find($this->id);
            if (!$order)
                return $this->apiResponse(null, 404, 'The order is not exist');
            if (auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard'))
                return $this->dashboardRun();
            else
                return $this->customerRun();
        } catch (Exception $ex) {
            return $this->apiResponse(null, 400, $ex->getMessage());
        }
    }

    private function dashboardRun()
    {
        $order = Order::find($this->id);
        if (!$order)
            return $this->apiResponse(null, 404, 'The order is not exist');
        $order->status = $this->status;
        if ($order->save())
            return $this->apiResponse(new OrderResource($order), 200, 'The order updated was success');
        return $this->apiResponse(null, 200, 'The order updated was failed');
    }

    private function customerRun()
    {
        $order = Order::find($this->id);
        if (!$order)
            return $this->apiResponse(null, 404, 'The order is not exist');
        if ($this->filled('color_id'))
            $order->product_id = $this->color_id;
        if ($this->filled('size_id'))
            $order->product_id = $this->size_id;
        if ($this->filled('address_id'))
            $order->address_id = $this->address_id;
        if ($this->filled('quantity'))
            $order->quantity = $this->quantity;
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
        if(auth('customer')->check() && auth('customer')->user()->tokenCan('user'))
        return [
            'color_id' => 'numeric|exists:colors,id',
            'size_id' => 'numeric|exists:sizes,id',
            'address' => 'string|max:255',
            'quantity' => 'numeric',
        ];
        if(auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard'))
            return [
                'status' => 'required|max:255'
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
