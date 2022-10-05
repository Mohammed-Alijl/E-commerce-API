<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Exception;

class ShowRequest extends FormRequest
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

    public function run($id)
    {
        try {
            $order = Order::find($id);
            if (!$order)
                return $this->apiResponse(null, 404, __('messages.order.found'));
            return $this->apiResponse(new OrderResource($order), 200, __('messages.order.one'));
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
}
