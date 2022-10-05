<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Controllers\Api\Traits\Api_Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class SetDefaultRequest extends FormRequest
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
            $address = auth('customer')->user()->addresses->find($this->address_id);
            if (!$address)
                return $this->apiResponse(null, 404, __('messages.messages.Address.setDefault.address_id.exists'));
            $oldDefault = auth('customer')->user()->addresses->where('default', '1')->first();
            if ($oldDefault) {
                $oldDefault->default = 0;
                $oldDefault->save();
            }
            $address->default = 1;
            if ($address->save())
                return $this->apiResponse(null, 200, __('messages.address.default.set'));
            return $this->apiResponse(null, 500, __('messages.failed'));
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
            'address_id' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return[
            'address_id.required'=>__('messages.address.address_id.required'),
            'address_id.numeric'=>__('messages.address.address_id.numeric')
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));

    }
}
