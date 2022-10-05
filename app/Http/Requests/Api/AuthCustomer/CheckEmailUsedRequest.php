<?php

namespace App\Http\Requests\Api\AuthCustomer;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
                return $this->apiResponse(['taken' => false], 200, __('messages.AuthCustomer.email.taken.not'));
            return $this->apiResponse(['taken' => true], 200, __('messages.AuthCustomer.email.taken.not'));
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
            'email' => 'required|email|max:255'
        ];
    }

    public function messages()
    {
        return[
          'email.required'=>__('messages.AuthCustomer.email.required'),
          'email.email'=>__('messages.AuthCustomer.email.email'),
          'email.max'=>__('messages.AuthCustomer.email.max'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
