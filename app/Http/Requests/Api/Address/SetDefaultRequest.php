<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Address;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

class SetDefaultRequest extends FormRequest
{
    use Api_Response;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('customer')->check();
    }

    public function run(){
        try {
            $address = auth('customer')->user()->addresses->find($this->address_id);
            if(!$address)
                return $this->apiResponse(null,404,'This address is not exist');
            $address->default = 1;
            if($address->save())
                return $this->apiResponse(null,200,'The address was set default');
            return $this->apiResponse(null,400,'some thing wrong please try again');
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
            'address_id'=>'required|numeric'
        ];
    }
    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null,401,'You should be login as an admin to be authorize'));
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null,422,$validator->errors()));

    }
}
