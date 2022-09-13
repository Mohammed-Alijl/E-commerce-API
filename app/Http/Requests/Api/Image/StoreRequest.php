<?php

namespace App\Http\Requests\Api\Image;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Image;
use App\Models\Product;
use App\Traits\imageTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

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
        return auth('dashboard')->check();
    }

    public function run()
    {
        try {
            $product = Product::find($this->product_id);
            if (!$product)
                return $this->apiResponse(null, 404, 'This product is not exist');
            $files = $this->file('images');
            foreach ($files as $file) {
                $imageName = $this->save_image($file, 'img/products');
                $image = new Image();
                $image->image = $imageName;
                $image->product_id = $this->product_id;
                $image->save();
            }
            return $this->apiResponse(null, 201, 'The image was added successfully');
        } catch (Exception $ex) {
            $this->apiResponse(null, 400, $ex->getMessage());
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

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, 'You should be auth as an admin'));
    }
}
