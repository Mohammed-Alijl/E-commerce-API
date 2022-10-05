<?php

namespace App\Http\Requests\Api\AuthAdmin;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Employee;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class RegisterRequest extends FormRequest
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
            $employee = new Employee();
            $employee->name = $this->name;
            $employee->email = $this->email;
            $employee->password = bcrypt($this->password);
            if ($employee->save())
                return $this->apiResponse(['access_token' => $employee->createToken('DashboardType', ['dashboard'])->accessToken], 201, __('messages.register'));
            return $this->apiResponse(null, 500, 'Admin create was failed');
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|min:6|max:32|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('messages.AuthDashboard.name.required'),
            'name.string' => __('messages.AuthDashboard.name.string'),
            'name.max' => __('messages.AuthDashboard.name.max'),
            'email.required' => __('messages.AuthDashboard.email.required'),
            'email.email' => __('messages.AuthDashboard.email.email'),
            'email.unique' => __('messages.AuthDashboard.email.unique'),
            'password.required' => __('messages.AuthDashboard.password.required'),
            'password.min' => __('messages.AuthDashboard.password.min'),
            'password.max' => __('messages.AuthDashboard.password.max'),
            'password.string' => __('messages.AuthDashboard.password.string'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
