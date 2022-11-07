<?php

namespace App\Http\Requests\Api\product;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\Product\ProductResource;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use App\Traits\ImageTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class StoreRequest extends FormRequest
{
    use Api_Response, ImageTrait;

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
                return $this->apiResponse(null, 500, __('messages.failed'));
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
            return $this->apiResponse(new ProductResource($product), 201, __('messages.product.create'));
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
            'name' => 'required|string|unique:products,name',
            'category_id' => 'required|numeric|exists:categories,id',
            'price' => 'required|numeric|min:1',
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
            'name.required' => __('messages.product.name.required'),
            'name.string' => __('messages.product.name.string'),
            'name.unique' => __('messages.product.name.unique'),
            'category_id.required' => __('messages.product.category_id.required'),
            'category_id.numeric' => __('messages.product.category_id.numeric'),
            'category_id.exists' => __('messages.product.category_id.exists'),
            'price.required' => __('messages.product.price.required'),
            'price.min' => __('messages.product.price.min'),
            'price.numeric' => __('messages.product.price.numeric'),
            'quantity.required' => __('messages.product.quantity.required'),
            'quantity.numeric' => __('messages.product.quantity.numeric'),
            'quantity.min' => __('messages.product.quantity.min'),
            'description.required' => __('messages.product.description.required'),
            'description.string' => __('messages.product.description.string'),
            'description.min' => __('messages.product.description.min'),
            'images.required' => __('messages.product.images.required'),
            'images.array' => __('messages.product.images.array'),
            'images.*.required' => __('messages.product.images.*.required'),
            'images.*.mimes' => __('messages.product.images.*.mimes'),
            'images.*.max' => __('messages.product.images.*.max'),
            'colors.required' => __('messages.product.colors.required'),
            'colors.array' => __('messages.product.colors.array'),
            'sizes.array' => __('messages.product.sizes.array'),
            'sizes.*.min' => __('messages.product.sizes.*.min'),
            'sizes.*.max' => __('messages.product.sizes.*.max'),
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
