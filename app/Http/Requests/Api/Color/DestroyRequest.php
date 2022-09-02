<?php

namespace App\Http\Requests\Api\Color;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ColorResource;
use App\Models\Color;
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
            $color = Color::find($this->color_id);
            if (!$color)
                return $this->apiResponse(null,404,'This color is not exist');
            if($color->delete())
                return $this->apiResponse(null,200,'The color deleted was success');
            return $this->apiResponse(null,400,'The color deleted was failed');
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
