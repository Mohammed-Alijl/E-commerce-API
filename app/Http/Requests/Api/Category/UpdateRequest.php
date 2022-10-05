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
        return auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard');
    }

    public function run($id)
    {
        try {
            $category = Category::find($id);
            if (!$category)
                return $this->apiResponse(null, 404, __('messages.category.found'));
            if ($this->filled('name'))
                $category->name = $this->name;
            if ($category->save())
                return $this->apiResponse(new CategoryResource($category), 200, __('messages.category.update'));
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
            'name' => 'string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => __('messages.category.name.string'),
            'name.max' => __('messages.category.name.max'),
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
