<?php

namespace App\Http\Requests\Api\Image;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use mysql_xdevapi\Exception;

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
            return $this->apiResponse(ImageResource::collection(Image::get()),200,'This is all images for all product');
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
