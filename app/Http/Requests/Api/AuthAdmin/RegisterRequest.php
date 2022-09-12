<?php

namespace App\Http\Requests\Api\AuthAdmin;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Employee;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

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

    public function run(){
        try {
            $employee = new Employee();
            $employee->name =  $this->name;
            $employee->email =  $this->email;
            $employee->password =bcrypt($this->password);
            if($employee->save())
                return $this->apiResponse(['access_token'=>$employee->createToken('DashboardType',['dashboard'])->accessToken],201,'The admin create was success');
            return $this->apiResponse(null,400,'the admin create was failed');
        }catch (Exception $ex){
            return $this->apiResponse(null,400,$ex->getMessage());
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
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:employees,email',
            'password'=>'required|min:6|max:32|string'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
