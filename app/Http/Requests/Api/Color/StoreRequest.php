<?php

namespace App\Http\Requests\Api\Color;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ColorResource;
use App\Models\Color;
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
            $color = new Color();
            $color->product_id = $this->product_id;
            $color->color = $this->color;
            if ($color->save())
                return $this->apiResponse(new ColorResource($color), 201, __('messages.color.create'));

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
            'product_id' => 'required|numeric|exists:products,id',
            'color' => 'required|min:3|max:6'
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => __('messages.color.product_id.required'),
            'product_id.numeric' => __('messages.color.product_id.numeric'),
            'product_id.exists' => __('messages.color.product_id.exists'),
            'color.required' => __('messages.color.color.required'),
            'color.min' => __('messages.color.color.min'),
            'color.max' => __('messages.color.color.max'),
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
