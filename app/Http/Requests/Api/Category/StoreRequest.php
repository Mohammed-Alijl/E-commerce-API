<?php

namespace App\Http\Requests\Api\Category;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Traits\imageTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class StoreRequest extends FormRequest
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

    public function run()
    {
        try {
            $category = new Category();
            $category->name = $this->name;
            $imageName = $this->save_image($this->file('image'), 'img/categories');
            $category->image = $imageName;
            if ($category->save())
                return $this->apiResponse(new CategoryResource($category), 201, __('messages.category.create'));
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
            'name' => 'required|string|max:255,unique:categories,name',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('messages.category.name.required'),
            'name.string' => __('messages.category.name.string'),
            'name.max' => __('messages.category.name.max'),
            'name.unique' => __('messages.category.name.unique'),
            'image.required' => __('messages.category.image.required'),
            'image.mimes' => __('messages.category.image.mimes'),
            'image.max' => __('messages.category.image.max'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
