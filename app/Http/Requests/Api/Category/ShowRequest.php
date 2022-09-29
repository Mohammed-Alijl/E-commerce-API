<?php

namespace App\Http\Requests\Api\Category;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\Category\ShowCategoryResource;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Exception;

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

    public function run($id)
    {
        try {
            $category = Category::find($id);
            if (!$category)
                return $this->apiResponse(null, 404, 'The category is not exist');
            return $this->apiResponse(new ShowCategoryResource($category), 200, 'This is the category');
        } catch (Exception $ex) {
            return $this->apiResponse(null, 500, $ex->getMessage());
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
