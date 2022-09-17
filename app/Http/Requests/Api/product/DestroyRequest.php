<?php

namespace App\Http\Requests\Api\product;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Product;
use App\Traits\imageTrait;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DestroyRequest extends FormRequest
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
            $product = Product::find($this->id);
            if (!$product)
                return $this->apiResponse(null, 404, 'This product is not exist');
            $images = $product->images;
            if ($product->delete()) {
                foreach ($images as $image)
                    $this->delete_image('img/products/' . $image->image);
                return $this->apiResponse(null, 200, 'The product was deleted successfully');
            }
            return $this->apiResponse(null, 400, 'The product was not deleted successfully');
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
            //
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, 'You should be login as an admin to be authorize'));
    }
}
