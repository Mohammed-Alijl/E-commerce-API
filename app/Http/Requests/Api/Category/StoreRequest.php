<?php

namespace App\Http\Requests\Api\Category;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\imageTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

class StoreRequest extends FormRequest
{
    use Api_Response,imageTrait;
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
            $category = new Category();
            $category->name = $this->name;
            $imageName = $this->save_image($this->file('image'),'img/categories');
            $category->image = $imageName;
            $category->save();
            return $this->apiResponse(new CategoryResource($category),201,'Category was created successfully');
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
            'name'=>'required|string|max:255',
            'image'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'The name of category is required',
            'name.string'=>'The name of category should be string',
            'name.max'=>'The name of category is too big',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null,422,$validator->errors()));
    }
}
