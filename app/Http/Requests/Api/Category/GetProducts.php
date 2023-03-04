<?php

namespace App\Http\Requests\Api\Category;

use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class GetProducts extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function run($id){
        try {
            $category = Category::find($id);
            if(!$category)
                return $this->apiResponse(null,404,__('messages.category.found'));
            return ProductResource::collection($category->products()->paginate(config('constants.CUSTOMER_PAGINATION')));
        }catch (\Exception $ex){
            return $this->apiResponse(null,500,$ex->getMessage());
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
