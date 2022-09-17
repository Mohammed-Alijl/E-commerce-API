<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\AddressResource;
use App\Models\Address;
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
        return auth('customer')->check() && auth('customer')->user()->tokenCan('user');
    }

    public function run()
    {
        try {
            $address = Address::find($this->id);
            if (!$address)
                return $this->apiResponse(null, 404, 'The address is not exist');
            if ($this->filled('title'))
                $address->title = $this->title;
            if ($this->filled('address'))
                $address->address = $this->address;
            if ($this->filled('default'))
                $address->default = $this->default;
            if ($address->save())
                return $this->apiResponse(new AddressResource($address), 200, 'The address updated was success');
            return $this->apiResponse(null, 400, 'The address updated was failed');

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
            'title' => 'string|max:255|min:1',
            'address' => 'string|max:255|min:1',
            'default' => 'numeric|between:0,1'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
