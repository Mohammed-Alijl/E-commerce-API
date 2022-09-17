<?php

namespace App\Http\Requests\Api\ProductCart;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ProductCartResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

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
        return auth('customer')->check() && auth('customer')->user()->tokenCan('user');
    }

    public function run()
    {
        try {
            $products = auth('customer')->user()->cart->productCart;
            return $this->apiResponse(ProductCartResource::collection($products), 200, 'All order in the cart');
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
        throw new HttpResponseException($this->apiResponse(null, 401, 'This action is unauthorized'));
    }
}
