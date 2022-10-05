<?php

namespace App\Http\Requests\Api\AuthCustomer;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    use Api_Response;

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
            $customer = User::where('email', $this->email)->first();
            if (Hash::check($this->password, $customer->password)) {
                $token = $customer->createToken('CustomerType', ['customer'])->accessToken;
                return $this->apiResponse(['access_token' => $token], 200, __('messages.login'));
            } else
                return $this->apiResponse(null, 422, __('messages.password.mismatch'));
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return[
            'email.required'=>__('messages.AuthCustomer.email.required'),
            'email.email'=>__('messages.AuthCustomer.email.email'),
            'email.exists'=>__('messages.AuthCustomer.email.exists'),
            'password.required'=>__('messages.AuthCustomer.password.required'),
            'password.string'=>__('messages.AuthCustomer.password.string'),
            'password.min'=>__('messages.AuthCustomer.password.min'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
