<?php

namespace App\Http\Requests\Api\User_like_product;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\User_like_product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class DestroyRequest extends FormRequest
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
        $like = DB::table('user_product')->where(['user_id'=>$this->user_id,'product_id'=>$this->product_id])->first();
        if(!$like)
            return $this->apiResponse(null,404,'The user does not like this product');
        if(DB::table('user_product')->delete($like->id))
            return $this->apiResponse(null,200,'The user like product deleted');
        return $this->apiResponse(null,200,'The user like product deleted was failed, please try again');
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
            'product_id'=>'required|numeric|exists:products,id'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null,422,$validator->errors()));
    }
}
