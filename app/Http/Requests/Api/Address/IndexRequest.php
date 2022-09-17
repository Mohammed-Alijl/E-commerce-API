<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;
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
        return auth('dashboard')->check() || auth('customer');
    }

    public function run()
    {
        try {
            if (auth('customer')->check() && auth('customer')->user()->tokenCan('user'))
                return $this->userRnu();
            if (auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard'))
                return $this->adminRun();
        } catch (Exception $ex) {
            return $this->apiResponse(null, 400, $ex->getMessage());
        }
    }

    private function adminRun()
    {
        return $this->apiResponse(AddressResource::collection(Address::get()), 200, 'This is all Address');
    }

    private function userRnu()
    {
        return $this->apiResponse(AddressResource::collection(auth('customer')->user()->addresses), 200, 'Tis is the address for this user');
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
