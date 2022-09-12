<?php

namespace App\Http\Requests\Api\LikeProduct;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\LikeResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
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
           $like = DB::table('likes')->insert([
                'user_id'=>$this->user_id,
                'product_id'=>$this->product_id
            ]);
           if($like)
                return $this->apiResponse(new LikeResource(DB::table('likes')->where(['user_id'=>$this->user_id,'product_id'=>$this->product_id])->first()),200,'The user like created was success');
           return $this->apiResponse(null,400,'The user like created was failed');
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
            'product_id'=>'required|numeric|exists:products,id'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null,422,$validator->errors()));
    }
    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null,401,'You should be auth as a user'));
    }
}
