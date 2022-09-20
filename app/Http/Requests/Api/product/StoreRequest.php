<?php

namespace App\Http\Requests\Api\product;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\Product\ProductResource;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
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
        return auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard');
    }

    public function run()
    {
        try {
            $product = new Product();
            $product->name = $this->name;
            $product->category_id = $this->category_id;
            $product->price = $this->price;
            $product->description = $this->description;
            $product->quantity = $this->quantity;
            if (!$product->save())
                return $this->apiResponse(null, 400, 'The product was not save, please try again');
            $files = $this->file('images');
            foreach ($files as $file) {
                $imageName = $this->save_image($file, 'img/products');
                $image = new Image();
                $image->product_id = $product->id;
                $image->image = $imageName;
                $image->save();
            }
            foreach ($this->colors as $color) {
                $colorObject = new Color();
                $colorObject->product_id = $product->id;
                $colorObject->color = $color;
                $colorObject->save();
            }
            if ($this->filled('sizes'))
                foreach ($this->sizes as $size) {
                    $sizeObject = new Size();
                    $sizeObject->product_id = $product->id;
                    $sizeObject->size = $size;
                    $sizeObject->save();
                }
            return $this->apiResponse(new ProductResource($product), 201, 'The product was created successfully');
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
            'name' => 'required|string|unique:products,name',
            'category_id' => 'required|numeric|exists:categories,id',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric|min:0',
            'description' => 'required|string|min:10',
            'images' => 'required|array',
            'images.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'colors' => 'required|array',
            'colors.*' => 'required|min:3|max:6',
            'sizes' => 'array|nullable',
            'sizes.*' => 'min:1|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name of product is required',
            'name.string' => 'The name of product should be string',
            'name.unique' => 'This product is already exist',
            'category_id.required' => 'The category id is required to know this product is exist in any category',
            'category_id.numeric' => 'The category id should be a numbers only',
            'category_id.exists' => 'This category is not exist',
            'price.required' => 'The price of product is required',
            'price.numeric' => 'The price should be a numbers only',
            'description.required' => 'The description of product is required',
            'description.string' => 'The description should be a string',
            'description.min' => 'The description of product should be at lest 10 character',
            'images.required' => 'The images for product is required',
            'images.imageTrait' => 'The file should be an imageTrait',
            'images.mimes' => 'The file extension should be jpeg, png, jpg, gif or svg',
            'images.max' => 'The file size should be maxim 2048'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, 'You should be login as an admin to be authorize'));
    }
}
