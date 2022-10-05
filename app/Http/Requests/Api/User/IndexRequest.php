<?php

namespace App\Http\Requests\Api\User;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\CustomerResource;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
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
        return auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard');
    }

    public function run()
    {
        try {
            return CustomerResource::collection(User::paginate($this->paginate_num ?? config('constants.ADMIN_PAGINATION')));
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

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('message.authorization')));
    }
}
