<?php

namespace App\Http\Requests\Api\User;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

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

    public function run(){
        $user = User::find($this->user_id);
        if(!$user)
            return $this->apiResponse(null,404,'The user is not exist');
        return $this->apiResponse(new UserResource($user),200,'This is the user');
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
