<?php

namespace App\Http\Requests\Api\product;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

class UpdateRequest extends FormRequest
{
    use Api_Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('dashboard')->check();;
    }

    public function run()
    {
        try {
            $product = Product::find($this->id);
            if (!$product)
                return $this->apiResponse(null, 404, 'The product is not exist');

            if ($this->filled('name'))
                $product->name = $this->name;

            if ($this->filled('category_id'))
                $product->category_id = $this->category_id;

            if ($this->filled('price'))
                $product->price = $this->price;

            if ($this->filled('description'))
                $product->description = $this->description;
            if ($product->save())
                return $this->apiResponse(new ProductResource($product), 200, 'The product updated was successes');

            return $this->apiResponse(new ProductResource($product), 400, 'The product updated was failed');

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
            'name' => 'min:1|string|unique:products,name',
            'category_id' => 'numeric|exists:categories,id',
            'price' => 'numeric|min:1',
            'description' => 'string|min:10'
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'The product id is required',
            'product_id.numeric' => 'The product id should be numeric',
            'product_id.exists' => 'The product is not exist',
            'name.string' => 'The name of product should be string',
            'name.unique' => 'This product is already exist',
            'category_id.numeric' => 'The category id should be a numbers only',
            'category_id.exists' => 'This category is not exist',
            'price.numeric' => 'The price should be a numbers only',
            'description.string' => 'The description should be a string',
            'description.min' => 'The description of product should be at lest 10 character',
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
