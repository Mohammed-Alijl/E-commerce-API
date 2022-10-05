<?php

namespace App\Http\Requests\Api\Image;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ImageResource;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Exception;

class IndexRequest extends FormRequest
{
    use Api_Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function run()
    {
        try {
            $product = Product::find($this->product_id);
            if (!$product)
                return $this->apiResponse(null, 404, __('messages.image.found'));
            return $this->apiResponse(ImageResource::collection($product->images), 200, __('messages.image.all'));
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
            //
        ];
    }
}
