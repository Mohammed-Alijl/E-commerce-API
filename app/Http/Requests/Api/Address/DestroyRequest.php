<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;
use mysql_xdevapi\Exception;

class DestroyRequest extends FormRequest
{
    use Api_Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('customer')->check();
    }

    public function run()
    {
        try {
            $address = Address::find($this->id);
            if (!$address)
                return $this->apiResponse(null, 404, 'The address is not exist');
            if ($address->delete())
                return $this->apiResponse(null, 200, 'The address deleted was success');
            return $this->apiResponse(null, 200, 'The address deleted was failed');
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
}
