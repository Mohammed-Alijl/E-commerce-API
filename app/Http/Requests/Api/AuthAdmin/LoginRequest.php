<?php

namespace App\Http\Requests\Api\AuthAdmin;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Employee;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;

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
            $admin = Employee::where('email', $this->email)->first();
            if (!Hash::check($this->password, $admin->password))
                return $this->apiResponse(null, 401, 'password is not true');
            $token = $admin->createToken('DashboardType',['dashboard'])->accessToken;
            return $this->apiResponse(['access_token' => $token], 200, 'Admin login success');
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
            'email' => 'required|email|exists:employees,email',
            'password' => 'required|string|min:6',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
