<?php

namespace App\Http\Requests\Api\Image;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;
use mysql_xdevapi\Exception;

class ShowRequest extends FormRequest
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
            $image = Image::find($this->id);
            if(!$image)
                return $this->apiResponse(null,404,'The image is not exist');
            return $this->apiResponse(new ImageResource($image),200,'This is the image');
        }catch (Exception $ex){
            $this->apiResponse(null,400,$ex->getMessage());
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
