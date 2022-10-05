<?php

namespace App\Http\Requests\Api\product;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

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
        return auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard');
    }

    public function run($id)
    {
        try {
            $product = Product::find($id);
            if (!$product)
                return $this->apiResponse(null, 404, __('messages.product.found'));

            if ($this->filled('name'))
                $product->name = $this->name;

            if ($this->filled('category_id'))
                $product->category_id = $this->category_id;

            if ($this->filled('price'))
                $product->price = $this->price;

            if ($this->filled('quantity'))
                $product->quantity = $this->quantity;

            if ($this->filled('description'))
                $product->description = $this->description;

            if ($product->save())
                return $this->apiResponse(new ProductResource($product), 200, __('messages.product.update'));

            return $this->apiResponse(new ProductResource($product), 500, __('messages.product.failed'));

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
            'name' => 'min:1|string|unique:products,name',
            'category_id' => 'numeric|exists:categories,id',
            'price' => 'numeric|min:1',
            'description' => 'string|min:10'
        ];
    }

    public function messages()
    {
        return [
            'name.string' => __('messages.product.name.string'),
            'name.min' => __('messages.product.name.min'),
            'name.unique' => __('messages.product.name.unique'),
            'category_id.numeric' => __('messages.product.category_id.numeric'),
            'category_id.exists' => __('messages.product.category_id.exists'),
            'price.numeric' => __('messages.product.price.numeric'),
            'price.min' => __('messages.product.price.min'),
            'description.string' => __('messages.product.description.string'),
            'description.min' => __('messages.product.description.min'),
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
