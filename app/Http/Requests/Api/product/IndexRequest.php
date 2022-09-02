<?php

namespace App\Http\Requests\Api\product;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\HomeResource;
use App\Models\Category;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class indexRequest extends FormRequest
{
    use Api_Response;
    public function authorize()
    {return true;}

    public function rules()
    {return [];}

    public function run()
    {
        try {
            $category = Category::find($this->category_id);
            if (!$category)
                return $this->apiResponse(null, 404, 'The category was not found');
            return $this->apiResponse(HomeResource::collection($category->products), 200, 'This is all products in the category');
        } catch (Exception $ex) {
            return $this->apiResponse(null, 400, $ex->getMessage());
        }
    }
}

