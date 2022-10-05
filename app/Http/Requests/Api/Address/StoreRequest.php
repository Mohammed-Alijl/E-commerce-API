<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Address;
use App\Http\Resources\AddressResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

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
        return auth('customer')->check() && auth('customer')->user()->tokenCan('customer');
    }

    public function run()
    {
        try {
            $address = new Address();
            $address->user_id = auth('customer')->id();
            $address->title = $this->title;
            $address->address = $this->address;
            if ($this->filled('default')) {
                if ($this->default == 1) {
                    $oldDefault = auth('customer')->user()->addresses->where('default', '1')->first();
                    if ($oldDefault) {
                        $oldDefault->default = 0;
                        $oldDefault->save();
                    }
                }
                $address->default = $this->default;
            }
            if ($address->save())
                return $this->apiResponse(new AddressResource(Address::find($address->id)), 201, __('messages.address.create'));
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
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'default' => 'numeric|between:0,1'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('messages.address.title.required'),
            'title.string' => __('messages.address.title.string'),
            'title.max' => __('messages.address.title.max'),
            'address.required' => __('messages.address.address.required'),
            'address.string' => __('messages.address.address.string'),
            'address.max' => __('messages.address.address.max'),
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
