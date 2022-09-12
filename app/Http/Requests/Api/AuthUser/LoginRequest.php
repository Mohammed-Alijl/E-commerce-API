<?php

namespace App\Http\Requests\Api\AuthUser;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\User;
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
            $user = User::where('email', $this->email)->first();
            if (Hash::check($this->password, $user->password)){
                $token = $user->createToken('UserType',['user'])->accessToken;
                $token = $user->createToken('UserType')->accessToken;
            }
            else
               return $this->apiResponse(null,422,'Password mismatch');
        } catch (Exception $ex) {
            return $this->apiResponse(null, 400, $ex->getMessage());
        }
    }

//    private function createNewToken($token)
//    {
//        return $this->apiResponse([
//            'access_token' => $token,
//            'token_type' => 'bearer',
//            'user' => auth()->user()
//        ], 200, 'login success');
//
//    }

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

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
