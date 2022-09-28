<?php

namespace App\Http\Requests\Api\ForgetPassword;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\ResetCodePassword;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckCodeRequest extends FormRequest
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

    public function run(){
        try {
            $passwordReset = ResetCodePassword::firstWhere(['code'=>$this->code,'email'=>$this->email]);
            if(!$passwordReset)
                return $this->apiResponse(['valid'=>false],422,'code is invalid');
            if ($passwordReset->created_at > now()->addHour()) {
                $passwordReset->delete();
                return $this->apiResponse(['valid'=>false],422,'code was expired');
            }
            return $this->apiResponse(['valid'=>true],200,'The code is valid');
        }catch (Exception $ex){
            return $this->apiResponse(null,500,$ex->getMessage());
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
            'email'=>'required|email|exists:users,email',
            'code'=>'required|numeric|min:100000|max:999999'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null,422,$validator->errors()));
    }
}