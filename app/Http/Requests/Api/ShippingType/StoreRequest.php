<?php

namespace App\Http\Requests\Api\ShippingType;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ShippingTypeResource;
use App\Models\ShippingType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class StoreRequest extends FormRequest
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

    public function run()
    {
        try {
            $shippingType = new ShippingType();
            $shippingType->title = $this->title;
            $shippingType->price = $this->price;
            $shippingType->minNumberDaysToArrival = $this->minNumberDaysToArrival;
            $shippingType->maxNumberDaysToArrival = $this->maxNumberDaysToArrival;
            if ($shippingType->save())
                return $this->apiResponse(new ShippingTypeResource($shippingType), 201, __('messages.shippingType.create'));
            return $this->apiResponse(null, 500, __('messages.failed'));
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
            'title' => 'required|string|min:1|max:255',
            'price' => 'required|numeric|min:0.1',
            'minNumberDaysToArrival' => 'required|numeric|min:1|max:' . $this->maxNumberDaysToArrival,
            'maxNumberDaysToArrival' => 'required|numeric|min:' . $this->minNumberDaysToArrival
        ];
    }

    public function messages()
    {
        return[
          'title.required'=>__('messages.shippingType.title.required'),
          'title.string'=>__('messages.shippingType.title.string'),
          'title.min'=>__('messages.shippingType.title.min'),
          'title.max'=>__('messages.shippingType.title.max'),
          'price.required'=>__('messages.shippingType.price.required'),
          'price.numeric'=>__('messages.shippingType.price.numeric'),
          'price.min'=>__('messages.shippingType.price.min'),
          'minNumberDaysToArrival.required'=>__('messages.shippingType.minNumberDaysToArrival.required'),
          'minNumberDaysToArrival.numeric'=>__('messages.shippingType.minNumberDaysToArrival.numeric'),
          'minNumberDaysToArrival.min'=>__('messages.shippingType.minNumberDaysToArrival.min'),
          'minNumberDaysToArrival.max'=>__('messages.shippingType.minNumberDaysToArrival.max'),
          'maxNumberDaysToArrival.required'=>__('messages.shippingType.maxNumberDaysToArrival.required'),
          'maxNumberDaysToArrival.numeric'=>__('messages.shippingType.maxNumberDaysToArrival.numeric'),
          'maxNumberDaysToArrival.min'=>__('messages.shippingType.maxNumberDaysToArrival.min'),
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
