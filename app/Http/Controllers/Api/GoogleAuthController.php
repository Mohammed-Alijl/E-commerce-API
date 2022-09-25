<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    use Api_Response;
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                $token = $finduser->createToken('UserType', ['user'])->accessToken;
                return $this->apiResponse(['access_token' => $token], 200, 'user login successfully');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456789')
                ]);

                $token = $newUser->createToken('UserType', ['user'])->accessToken;
                return $this->apiResponse(['access_token' => $token], 200, 'user login successfully');
            }

        } catch (Exception $ex) {
//            dd($e->getMessage());
            return $this->apiResponse(null,500,$ex->getMessage());
        }
    }
}



