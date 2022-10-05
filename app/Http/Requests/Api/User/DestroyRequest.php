<?php

namespace App\Http\Requests\Api\User;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

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
        return auth('dashboard')->check() || auth('customer')->check();
    }

    public function run($id)
    {
        try {
            if (auth('customer')->check() && auth('customer')->user()->tokenCan('customer'))
                return $this->customerRun();
            if (auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard'))
                return $this->dashboardRun($id);
        } catch (Exception $ex) {
            return $this->apiResponse(null, 500, $ex->getMessage());
        }
    }

    private function customerRun()
    {
        if (auth('customer')->user()->delete())
            return $this->apiResponse(null, 200, __('messages.AuthCustomer.delete'));
        return $this->apiResponse(null, 500, __('messages.failed'));
    }

    private function dashboardRun($id)
    {
        $customer = User::find($id);
        if (!$customer)
            return $this->apiResponse(null, 404, __('messages.AuthCustomer.found'));
        if ($customer->delete())
            return $this->apiResponse(null, 200, __('messages.AuthCustomer.delete'));
        return $this->apiResponse(null, 500, __('messages.failed'));
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
        throw new HttpResponseException($this->apiResponse(null, 401, __('message.authorization')));
    }
}
