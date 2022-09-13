<?php

namespace App\Http\Requests\Api\User;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
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
        return auth('dashboard')->check();
    }

    public function run()
    {
        try {
            $user = User::find($this->id);
            if (!$user)
                return $this->apiResponse(null, 404, 'The user is not exist');
            if ($user->delete())
                return $this->apiResponse(null, 200, 'The user deleted was success');
            return $this->apiResponse(null, 400, 'The user deleted was failed');
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

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, 'you are not authorize'));
    }
}
