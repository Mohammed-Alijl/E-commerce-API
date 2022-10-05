<?php

namespace App\Http\Requests\Api\LikeProduct;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\LikeResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
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
        return auth('customer')->check() && auth('customer')->user()->tokenCan('customer');
    }

    public function run()
    {
        try {
            $like = DB::table('likes')->insert([
                'user_id' => auth('customer')->id(),
                'product_id' => $this->product_id
            ]);
            if ($like)
                return $this->apiResponse(new LikeResource(DB::table('likes')->where(['user_id' => auth('customer')->id(), 'product_id' => $this->product_id])->first()), 201, __('messages.like.create'));
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
            'product_id' => 'required|numeric|exists:products,id'
        ];
    }

    public function messages()
    {
        return[
            'product_id.required' => __('messages.color.product_id.required'),
            'product_id.numeric' => __('messages.color.product_id.numeric'),
            'product_id.exists' => __('messages.color.product_id.exists'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.required')));
    }
}
