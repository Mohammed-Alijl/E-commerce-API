<?php

namespace App\Http\Requests\Api\User;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\CustomerResource;
use App\Models\Cart;
use App\Models\User;
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
        return auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard');
    }

    public function run()
    {
        try {
            $customer = new User();
            $customer->name = $this->name;
            $customer->email = $this->email;
            $customer->password = bcrypt($this->password);
            $customer->phone = $this->phone;
            if ($this->filled('nick_name'))
                $customer->nick_name = $this->nick_name;
            if ($this->filled('date_of_birth'))
                $customer->date_of_birth = $this->date_of_birth;
            if ($image = $this->file('image')) {
                $imageName = $this->save_image($image, "img/customers/profile");
                $customer->image = $imageName;
            }
            if ($customer->save()) {
                $cart = new Cart();
                $cart->user_id = $customer->id;
                $cart->save();
                return $this->apiResponse(new CustomerResource($customer), 201, __('messages.AuthCustomer.create'));
            }
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
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:30',
            'nick_name' => 'required|string|max:255',
            'date_of_birth' => 'required|string|max:255',
            'phone' => 'required|min:6|max:15',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('messages.AuthCustomer.name.required'),
            'name.string' => __('messages.AuthCustomer.name.string'),
            'name.max' => __('messages.AuthCustomer.name.max'),
            'email.required' => __('messages.AuthCustomer.email.required'),
            'email.email'=>__('messages.AuthCustomer.email.email'),
            'email.max'=>__('messages.AuthCustomer.email.max'),
            'email.unique' => __('messages.AuthCustomer.email.unique'),
            'password.required' => __('messages.AuthCustomer.password.required'),
            'password.string' => __('messages.AuthCustomer.password.string'),
            'password.min' => __('messages.AuthCustomer.password.min'),
            'password.max' => __('messages.AuthCustomer.password.max'),
            'nick_name.required'=>__('messages.AuthCustomer.nick_name.required'),
            'nick_name.string'=>__('messages.AuthCustomer.nick_name.string'),
            'nick_name.max'=>__('messages.AuthCustomer.nick_name.max'),
            'date_of_birth.required'=>__('messages.AuthCustomer.date_of_birth.required'),
            'date_of_birth.string'=>__('messages.AuthCustomer.date_of_birth.string'),
            'date_of_birth.max'=>__('messages.AuthCustomer.date_of_birth.max'),
            'phone.required'=>__('messages.AuthCustomer.phone.required'),
            'phone.min'=>__('messages.AuthCustomer.phone.min'),
            'phone.max'=>__('messages.AuthCustomer.phone.max'),
            'image.mimes'=>__('messages.AuthCustomer.image.mimes'),
            'image.max'=>__('messages.AuthCustomer.image.max'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, 'you are not authorize'));
    }
}
