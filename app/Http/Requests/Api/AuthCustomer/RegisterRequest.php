<?php

namespace App\Http\Requests\Api\AuthCustomer;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Cart;
use App\Models\User;
use App\Traits\ImageTrait;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    use Api_Response, imageTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
                $token = $customer->createToken('CustomerType', ['customer'])->accessToken;
                return $this->apiResponse(['access_token' => $token], 201, 'customer register success');
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
            'email' => 'required|string|email|max:255|unique:users',
            'nick_name' => 'required|string|max:255',
            'date_of_birth' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:30',
            'phone' => 'required|min:6|max:15',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name of customer is required',
            'name.string' => 'The name of customer should be string',
            'name.max' => 'The name of customer is too big',
            'email.required' => 'The email customer is required',
            'email.unique' => 'This email was already taken',
            'password.required' => 'The password is required',
            'password.min' => 'The password should be at lest 6 character',
            'password.max' => 'The password should be maxim 30 character ',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
