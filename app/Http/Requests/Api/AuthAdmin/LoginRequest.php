<?php

namespace App\Http\Requests\Api\AuthAdmin;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Employee;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Exception;

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
            $employee = Employee::where('email', $this->email)->first();
            if (!Hash::check($this->password, $employee->password))
                return $this->apiResponse(null, 401, __('password.mismatch'));
            $token = $employee->createToken('DashboardType', ['dashboard'])->accessToken;
            return $this->apiResponse(['access_token' => $token], 200, __('messages.login'));
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
            'email' => 'required|email|exists:employees,email',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return[
          'email.required'=>__('messages.AuthDashboard.email.required'),
          'email.exists'=>__('messages.AuthDashboard.email.exists'),
          'email.email'=>__('messages.AuthDashboard.email.email'),
          'password.required'=>__('messages.AuthDashboard.password.required'),
          'password.string'=>__('messages.AuthDashboard.password.string'),
          'password.min'=>__('messages.AuthDashboard.password.min'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
