<?php

namespace App\Http\Requests\Api\ShippingType;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ShippingTypeResource;
use App\Models\ShippingType;
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
            $shippingType = ShippingType::find($id);
            if (!$shippingType)
                return $this->apiResponse(null, 404, 'The shipping type is not exist');
            if ($this->filled('title'))
                $shippingType->title = $this->title;
            if ($this->filled('price'))
                $shippingType->price = $this->price;
            if ($this->filled('minNumberDaysToArrival')) {
                if ($shippingType->maxNumberDaysToArrival < $this->minNumberDaysToArrival)
                    return $this->apiResponse(null, 422, 'minNumberDaysToArrival should be less than ' . $shippingType->maxNumberDaysToArrival);
                $shippingType->minNumberDaysToArrival = $this->minNumberDaysToArrival;
            }
            if ($this->filled('maxNumberDaysToArrival')) {
                if ($this->maxNumberDaysToArrival < $shippingType->minNumberDaysToArrival)
                    return $this->apiResponse(null, 422, 'maxNumberDaysToArrival should be greater than ' . $shippingType->minNumberDaysToArrival);
                $shippingType->maxNumberDaysToArrival = $this->maxNumberDaysToArrival;
            }
            if ($shippingType->save())
                return $this->apiResponse(new ShippingTypeResource($shippingType), 200, 'Shipping type update was success');
            return $this->apiResponse(null, 500, 'Shipping type update was failed, please try again');
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
            'title' => 'string|min:1|max:255',
            'price' => 'numeric|min:0.1',
            'minNumberDaysToArrival' => 'numeric|min:1',
            'maxNumberDaysToArrival' => 'numeric'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, 'you are not authorize'));
    }
}
