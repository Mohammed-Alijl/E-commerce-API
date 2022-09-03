<?php

namespace App\Http\Requests\Api\Category;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\ShowResource;
use App\Models\Category;
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
            $category= Category::find($this->category_id);
            if(!$category)
                return $this->apiResponse(null,404,'The category was not found');
            return $this->apiResponse(new ShowResource($category),200,'This is the category');
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
