<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthAdmin\LoginRequest;
use App\Http\Requests\Api\AuthAdmin\LogoutRequest;
use App\Http\Requests\Api\AuthAdmin\RegisterRequest;

class AuthDashboardController extends Controller
{
    public function login(LoginRequest $request){
        return $request->run();
    }

    public function register(RegisterRequest $request){
        return $request->run();
    }

    public function logout(LogoutRequest $request){
        return $request->run();
    }
}
