<?php

namespace App\Http\Requests\Api\ForgetPassword;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordRequest extends FormRequest
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
            $passwordReset = ResetCodePassword::firstWhere(['code' => $this->code, 'email' => $this->email]);
            if (!$passwordReset)
                return $this->apiResponse(['reset' => false], 422, 'The code is valid');
            if ($passwordReset->created_at->addHour() < now()) {
                $passwordReset->delete();
                return $this->apiResponse(['reset' => false], 422, 'The code was expired');
            }
            $customer = User::firstWhere('email', $passwordReset->email);
            $customer->password = bcrypt($this->password);
            if ($customer->save())
                $passwordReset->delete();
            return $this->apiResponse(['reset' => true], 200, 'password has been successfully reset');
        } catch (Exception $ex) {
            return $this->apiResponse(['reset' => false], 500, $ex->getMessage());
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
            'code' => 'required|numeric|min:100000|max:999999'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
