<?php

namespace App\Http\Requests\Api\User;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\UserResource;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

class StoreRequest extends FormRequest
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
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = bcrypt($this->password);
            $user->phone = $this->phone;
            if ($this->filled('nick_name'))
                $user->nick_name = $this->nick_name;
            if ($this->filled('date_of_birth'))
                $user->date_of_birth = $this->date_of_birth;
            if ($image = $this->file('image')) {
                $imageName = $this->save_image($image, "img/users/profile");
                $user->image = $imageName;
            }
            if ($user->save()) {
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->save();
                return $this->apiResponse(new UserResource($user), 201, 'user created successfully');
            }
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
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'nick_name' => 'required|string|max:255',
            'date_of_birth' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:30',
            'phone' => 'required|min:6|max:15',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, 'you are not authorize'));
    }
}
