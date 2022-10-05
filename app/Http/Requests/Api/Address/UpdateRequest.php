<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

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
        return auth('customer')->check() && auth('customer')->user()->tokenCan('customer');
    }

    public function run($id)
    {
        try {
            $address = Address::find($id);
            if (!$address)
                return $this->apiResponse(null, 404, __('messages.address.found'));
            if ($this->filled('title'))
                $address->title = $this->title;
            if ($this->filled('address'))
                $address->address = $this->address;
            if ($this->filled('default'))
                $address->default = $this->default;
            if ($address->save())
                return $this->apiResponse(new AddressResource($address), 200, __('messages.address.update'));
            return $this->apiResponse(null, 500, __('messages.address.update'));

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
            'title' => 'string|max:255|min:1',
            'address' => 'string|max:255|min:1',
            'default' => 'numeric|between:0,1'
        ];
    }

    public function messages()
    {
        return [
            'title.string' => __('messages.address.title.string'),
            'title.max' => __('messages.address.title.max'),
            'title.min' => __('messages.address.title.min'),
            'address.string' => __('messages.address.address.string'),
            'address.max' => __('messages.address.address.max'),
            'address.min' => __('messages.address.address.min'),
            'default.numeric' => __('messages.address.default.numeric'),
            'default.between' => __('messages.address.default.between'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }

}
