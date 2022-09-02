<?php

namespace App\Http\Requests\Api\User_like_product;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\LikeResource;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            $user = User::find($this->user_id);
            if(!$user)
                return $this->apiResponse(null,404,'This user is not exist');
            $likes = $user->likes;
            return $this->apiResponse(new LikeResource($likes),200,'This is all product the user like');
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
}
