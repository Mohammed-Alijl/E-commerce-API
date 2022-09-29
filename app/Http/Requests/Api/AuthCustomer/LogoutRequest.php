<?php

namespace App\Http\Requests\Api\AuthCustomer;

use App\Http\Controllers\Api\Traits\Api_Response;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LogoutRequest extends FormRequest
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
            $customer = auth('api')->user()->token();
            if ($customer->revoke())
                return $this->apiResponse(null, 200, 'Customer successfully signed out');
            return $this->apiResponse(null, 500, 'Customer signed out failed, please try again');
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
        throw new HttpResponseException($this->apiResponse(null, 401, 'you are not authorized'));
    }
}
