<?php

namespace App\Http\Requests\Api\Size;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\SizeResource;
use App\Models\Size;
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
            $size = new Size();
            $size->product_id = $this->product_id;
            $size->size = $this->size;
            if ($size->save())
                return $this->apiResponse(new SizeResource($size), 201, __('messages.size.create'));
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
            'size' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => __('messages.size.product_id.required'),
            'product_id.numeric' => __('messages.size.product_id.numeric'),
            'product_id.exists' => __('messages.size.product_id.exists'),
            'size.required' => __('messages.size.size.required'),
            'size.max' => __('messages.size.size.max'),
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
