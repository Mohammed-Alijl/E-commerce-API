<?php

namespace App\Http\Requests\Api\User;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    use Api_Response, ImageTrait;

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
        $user = User::find($this->user_id);
        if (!$user)
            return $this->apiResponse(null, 404, 'The user is not exist');
        if ($this->filled('name'))
            $user->name = $this->name;
        if ($this->filled('email'))
            $user->email = $this->email;
        if ($this->filled('nick_name'))
            $user->nick_name = $this->nick_name;
        if ($this->filled('phone'))
            $user->phone = $this->phone;
        if ($this->filled('date_of_birth'))
            $user->date_of_birth = $this->date_of_birth;
        if ($this->filled('password')){
                $user->password = $this->bcrypt($this->password);
        }
        if ($this->filled('image')){
            $this->delete_image('img/users/profile/' . $user->image);
            $user->image = $this->save_image($this->file('image'),'img/users/profile/');
        }
        if($user->save())
            return $this->apiResponse(new UserResource($user),200,'The user updated was success');
        return $this->apiResponse(new UserResource($user),400,'The user updated was failed');

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|max:100',
            'email' => 'string|email|max:255|unique:users',
            'nick_name'=>'string|max:255',
            'date_of_birth'=>'string|max:255',
            'password' => 'string|min:6|max:30',
            'phone'=>'min:6|max:15',
            'image'=>'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null,422,$validator->errors()));
    }
}
