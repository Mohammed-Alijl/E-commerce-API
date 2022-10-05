<?php

namespace App\Http\Requests\Api\ShippingType;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ShippingTypeResource;
use App\Models\ShippingType;
use Illuminate\Foundation\Http\FormRequest;
use Exception;

class ShowRequest extends FormRequest
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

    public function run($id)
    {
        try {
            $shippingType = ShippingType::find($id);
            if (!$shippingType)
                return $this->apiResponse(null, 404, __('messages.shippingType.found'));
            return $this->apiResponse(new ShippingTypeResource($shippingType), 200, __('messages.shippingType.one'));
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
