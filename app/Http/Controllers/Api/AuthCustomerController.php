<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthCustomer\CheckEmailUsedRequest;
use App\Http\Requests\Api\AuthCustomer\LoginRequest;
use App\Http\Requests\Api\AuthCustomer\LogoutRequest;
use App\Http\Requests\Api\AuthCustomer\RegisterRequest;
use App\Http\Requests\Api\AuthCustomer\CustomerProfileRequest;

class AuthCustomerController extends Controller
{
    public function login(LoginRequest $request)
    {
        return $request->run();
    }

    public function register(RegisterRequest $request)
    {
        return $request->run();
    }

    public function logout(LogoutRequest $request)
    {
        return $request->run();
    }

    public function customerProfile(CustomerProfileRequest $request)
    {
        return $request->run();
    }

    public function isEmailUsed(CheckEmailUsedRequest $request)
    {
        return $request->run();
    }
}
