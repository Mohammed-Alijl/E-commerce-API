<?php

namespace App\Http\Requests\Api\Category;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Category;
use App\Traits\imageTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

class DestroyRequest extends FormRequest
{
    use Api_Response,imageTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $auth = Auth::guard('dashboard');
        return $auth->check();
    }

    public function run(){
        try {
            $category = Category::find($this->id);
            if(!$category)
                return $this->apiResponse(null,404,'The category was not found');
            $categoryImage = $category->image;
            $products = $category->products;
            foreach ($products as $product){
                foreach ($product->images as $image)
                $this->delete_image("img/products/$image->image");
            }
            if($category->delete()){
                $this->delete_image("img/categories/$categoryImage");
                return $this->apiResponse(null,200,'The category was deleted');
            }
            return $this->apiResponse(null,400,'The category was not deleted, please try again');
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
