<?php

namespace App\Http\Requests\Api\User;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\CustomerResource;
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

    public function run()
    {
        try {
            $customer = auth('customer')->user();
            if ($this->filled('name'))
                $customer->name = $this->name;
            if ($this->filled('email'))
                $customer->email = $this->email;
            if ($this->filled('nick_name'))
                $customer->nick_name = $this->nick_name;
            if ($this->filled('phone'))
                $customer->phone = $this->phone;
            if ($this->filled('date_of_birth'))
                $customer->date_of_birth = $this->date_of_birth;
            if ($this->filled('password')) {
                $customer->password = $this->bcrypt($this->password);
            }
//        if ($this->filled('image')){
//            $this->delete_image('img/users/profile/' . $user->image);
//            $user->image = $this->save_image($this->file('image'),'img/users/profile/');
//        }
            if ($customer->save())
                return $this->apiResponse(new CustomerResource($customer), 200, __('messages.AuthCustomer.update'));
            return $this->apiResponse(new CustomerResource($customer), 500, __('messages.failed'));
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
            'name' => 'string|max:100',
            'email' => 'email|max:255|unique:users',
            'password' => 'string|min:6|max:30',
            'nick_name' => 'string|max:255',
            'date_of_birth' => 'string|max:255',
            'phone' => 'min:6|max:15',
//            'image'=>'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'name.string' => __('messages.AuthCustomer.name.string'),
            'name.max' => __('messages.AuthCustomer.name.max'),
            'email.email'=>__('messages.AuthCustomer.email.email'),
            'email.max'=>__('messages.AuthCustomer.email.max'),
            'email.unique' => __('messages.AuthCustomer.email.unique'),
            'password.string' => __('messages.AuthCustomer.password.string'),
            'password.min' => __('messages.AuthCustomer.password.min'),
            'password.max' => __('messages.AuthCustomer.password.max'),
            'nick_name.string'=>__('messages.AuthCustomer.nick_name.string'),
            'nick_name.max'=>__('messages.AuthCustomer.nick_name.max'),
            'date_of_birth.string'=>__('messages.AuthCustomer.date_of_birth.string'),
            'date_of_birth.max'=>__('messages.AuthCustomer.date_of_birth.max'),
            'phone.min'=>__('messages.AuthCustomer.phone.min'),
            'phone.max'=>__('messages.AuthCustomer.phone.max'),
//            'image.mimes'=>__('messages.AuthCustomer.image.mimes'),
//            'image.max'=>__('messages.AuthCustomer.image.max'),
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
