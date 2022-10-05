<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;

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

            $customer = User::where('google_id', $user->id)->first();

            if ($customer) {

                $token = $customer->createToken('CustomerType', ['customer'])->accessToken;
                return $this->apiResponse(['access_token' => $token], 200, __('messages.login'));

            } else {
                $newCustomer = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456789')
                ]);

                $token = $newCustomer->createToken('CustomerType', ['customer'])->accessToken;
                return $this->apiResponse(['access_token' => $token], 200, __('messages.login'));
            }

        } catch (Exception $ex) {
            return $this->apiResponse(null, 500, $ex->getMessage());
        }
    }
}



