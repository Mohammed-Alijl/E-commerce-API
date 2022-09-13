<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

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
        return auth('dashboard')->check() || auth('api')->check();
    }

    public function run()
    {
        if (auth('dashboard')->check())
            return $this->adminRun();
        else
            return $this->userRun();
    }

    private function adminRun()
    {
        try {
            return $this->apiResponse(OrderResource::collection(Order::get()), 200, 'This is all orders');
        } catch (Exception $ex) {
            return $this->apiResponse(null, 400, $ex->getMessage());
        }
    }

    private function userRun()
    {
        try {
            return $this->apiResponse(OrderResource::collection(auth('api')->user()->orders), 200, 'This is all orders');
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
            //
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, 'This action is unauthorized'));
    }

}
