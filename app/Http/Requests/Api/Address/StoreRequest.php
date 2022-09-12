<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\Address\AddressResource;
use App\Models\Address;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

class StoreRequest extends FormRequest
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
            $address = new Address();
            $address->user_id = $this->user_id;
            $address->title = $this->title;
            $address->address = $this->address;
            $address->default = $this->default;
            if($address->save())
                return $this->apiResponse(new AddressResource($address),200,'The address created was success');
            return $this->apiResponse(null,400,'The address created was failed, please try again');
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
            'user_id'=>'required|numeric|exists:users,id',
            'title'=>'required|string|max:255',
            'address'=>'required|string|max:255',
            'default'=>'required|numeric|between:0,1'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null,422,$validator->errors()));
    }

}
