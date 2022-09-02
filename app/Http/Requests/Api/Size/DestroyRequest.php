<?php

namespace App\Http\Requests\Api\Size;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Size;
use Illuminate\Foundation\Http\FormRequest;
use mysql_xdevapi\Exception;

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
        try {
            $size = Size::find($this->size_id);
            if(!$size)
                return $this->apiResponse(null,404,'This size is not exist');
            if($size->delete())
                return $this->apiResponse(null,200,'The size deleted was success');
            return $this->apiResponse(null,400,'The size deleted was failed, please try again');
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
