<?php

namespace App\Http\Requests\Api\Category;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Category;
use App\Traits\imageTrait;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        return auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard');
    }

    public function run($id)
    {
        try {
            $category = Category::find($id);
            if (!$category)
                return $this->apiResponse(null, 404, __('messages.category.found'));
            $categoryImage = $category->image;
            $products = $category->products;
            foreach ($products as $product) {
                foreach ($product->images as $image)
                    $this->delete_image("img/products/$image->image");
            }
            if ($category->delete()) {
                $this->delete_image("img/categories/$categoryImage");
                return $this->apiResponse(null, 200, __('messages.category.delete'));
            }
            return $this->apiResponse(null, 500, __('messages.failed'));
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

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null,401,__('messages.authorization')));
    }
}
