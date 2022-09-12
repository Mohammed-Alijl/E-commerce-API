<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthUser\CheckEmailUsedRequest;
use App\Http\Requests\Api\AuthUser\LoginRequest;
use App\Http\Requests\Api\AuthUser\LogoutRequest;
use App\Http\Requests\Api\AuthUser\RegisterRequest;
use App\Http\Requests\Api\AuthUser\UserProfileRequest;
class AuthUserController extends Controller
{
    public function login(LoginRequest $request){
        return $request->run();
    }

    public function register (RegisterRequest $request) {
        return $request->run();
    }

    public function logout(LogoutRequest $request) {
        return $request->run();
    }

    public function userProfile(UserProfileRequest $request) {
        return $request->run();
    }

    public function isEmailUsed(CheckEmailUsedRequest $request){
        return $request->run();
    }












//    protected function createToken(array $data)
//    {
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//            'api_token' => Str::random(60),
//        ]);
//    }
//
//    public function loginTest(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'password' => 'required|string',
//            'email' => 'required|string|email',
//        ]);
//        if ($validator->fails()) {
//            return response(['errors' => $validator->errors()->all()], 422);
//        }
//        else {
//            $credentials = $request->only(['email', 'password']);
//            if(!Auth::attempt($credentials)) {
//                return response()->json(['success' => false, 'message' => 'invalid Email or Password!']);
//            } else {
//                $user = Auth::user();
//                $accessToken = $user->createToken('AuthToken')->accessToken;
//                $user['token'] = $accessToken;
//                $response =  array('success' => true, 'data' => $user,'token' => $accessToken,'messgae' => "Login success");
//                return response()->json($response);
//            }
//        }
//    }
}
