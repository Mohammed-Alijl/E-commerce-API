<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\AddressResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

class GetDefaultRequest extends FormRequest
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
            $address = auth('customer')->user()->addresses->where('default',1)->first();
            if(!$address)
                return $this->apiResponse(null,404,'There is not any default address');
            return $this->apiResponse(new AddressResource($address),200,'This is the default address');
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
            //
        ];
    }
    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null,401,'You should be login as an admin to be authorize'));
    }
}
