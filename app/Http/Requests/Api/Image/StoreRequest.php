<?php

namespace App\Http\Requests\Api\Image;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Image;
use App\Models\Product;
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
            $product = Product::find($this->product_id);
            if (!$product)
                return $this->apiResponse(null, 404, __('messages.product.found'));
            $files = $this->file('images');
            foreach ($files as $file) {
                $imageName = $this->save_image($file, 'img/products');
                $image = new Image();
                $image->image = $imageName;
                $image->product_id = $this->product_id;
                $image->save();
            }
            return $this->apiResponse(null, 201, __('messages.image.create'));
        } catch (Exception $ex) {
            $this->apiResponse(null, 500, $ex->getMessage());
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
            'images' => 'array|required',
            'images.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'images.required' => __('messages.image.images.required'),
            'images.array' => __('messages.image.images.array'),
            'images.*.required' => __('messages.image.images.*.required'),
            'images.*.mimes' => __('messages.image.images.*.mimes'),
            'images.*.max' => __('messages.image.images.*.max'),
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
