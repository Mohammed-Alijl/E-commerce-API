<?php

namespace App\Http\Requests\Api\Color;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

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
        return auth('dashboard')->check();
    }

    public function run()
    {
        try {
            $color = new Color();
            $color->product_id = $this->product_id;
            $color->color = $this->color;
            if ($color->save())
                return $this->apiResponse(new ColorResource($color), 201, 'The color created was success');

            return $this->apiResponse(null, 400, 'The color created was failed, please try again');

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
            'product_id' => 'required|numeric|exists:products,id',
            'color' => 'required|min:4|max:7'
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
