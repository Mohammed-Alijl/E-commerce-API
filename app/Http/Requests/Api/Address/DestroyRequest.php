<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        return auth('customer')->check() && auth('customer')->user()->tokenCan('customer');
    }

    public function run($id)
    {
        try {
            $address = Address::find($id);
            if (!$address)
                return $this->apiResponse(null, 404, __('messages.address.found'));
            if ($address->delete())
                return $this->apiResponse(null, 200, __('messages.address.delete'));
            return $this->apiResponse(null, 200, __('messages.failed'));
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
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
