<?php

namespace App\Http\Requests\Api\AuthCustomer;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class CheckEmailUsedRequest extends FormRequest
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

    public function run()
    {
        try {
            $customer = User::where('email', $this->email)->first();
            if (!$customer)
                return $this->apiResponse(['taken' => false], 200, 'This email was not taken yet');
            return $this->apiResponse(['taken' => true], 200, 'This email was taken');
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
            'email' => 'required|email'
        ];
    }
}
