<?php

namespace App\Http\Requests\Api\Category;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Traits\imageTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

class UpdateRequest extends FormRequest
{
    use Api_Response, imageTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('dashboard')->check();
    }

    public function run()
    {
        try {
            $category = Category::find($this->id);
            if (!$category)
                return $this->apiResponse(null, 404, 'The category was not found');
            if ($this->filled('name'))
                $category->name = $this->name;
            if ($category->save())
                return $this->apiResponse(new CategoryResource($category), 200, 'The category was updated');
            return $this->apiResponse(null, 400, 'some thing wrong the category was not updated');
        } catch (Exception $ex) {
            return $this->apiResponse(null, 400, $ex->getMessage());
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
            'name' => 'string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'The name of category should be string',
            'name.max' => 'The name of category is too big',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

}
