<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;
use Exception;

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
            if (auth('customer')->check() && auth('customer')->user()->tokenCan('customer'))
                return $this->userRun();
            if (auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard'))
                return $this->dashboradRun();
        } catch (Exception $ex) {
            return $this->apiResponse(null, 500, $ex->getMessage());
        }
    }

    private function dashboradRun()
    {
        return $this->apiResponse(AddressResource::collection(Address::get()), 200, 'This is all Address');
    }

    private function userRun()
    {
        return $this->apiResponse(AddressResource::collection(auth('customer')->user()->addresses), 200, 'Tis is the address for this customer');
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
