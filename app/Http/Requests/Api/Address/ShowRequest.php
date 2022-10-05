<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Address;
use App\Http\Resources\AddressResource;
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
            $address = Address::find($id);
            if (!$address)
                return $this->apiResponse(null, 404, __('messages.address.found'));
            return $this->apiResponse(new AddressResource($address), 200, __('messages.address.one'));
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
