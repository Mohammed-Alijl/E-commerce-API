<?php

namespace App\Http\Requests\Api\Image;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Image;
use App\Traits\imageTrait;
use Illuminate\Foundation\Http\FormRequest;
use mysql_xdevapi\Exception;

class DestroyRequest extends FormRequest
{
    use Api_Response, imageTrait;
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
            $image = Image::find($this->image_id);
            if(!$image)
                return $this->apiResponse(null,404,'The image is not exist');
            if($image->delete()){
                $this->delete_image('img/products/' . $image->image);
                return $this->apiResponse(null,200,'The image was deleted successfully');
            }
            return $this->apiResponse(null,400,'The image was not deleted successfully, please try again');
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
