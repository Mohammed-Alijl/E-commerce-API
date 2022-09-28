<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ForgetPassword\CheckCodeRequest;
use App\Http\Requests\Api\ForgetPassword\ResetPasswordRequest;
use App\Http\Requests\Api\ForgetPassword\SendCodeRequest;

class ForgetPasswordController extends Controller
{
    public function sendCode(SendCodeRequest $request){
        return $request->run();
    }
    public function checkCode(CheckCodeRequest $request){
        return $request->run();
    }
    public function resetPassword(ResetPasswordRequest $request){
        return $request->run();
    }
}
