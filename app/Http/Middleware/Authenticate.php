<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\Traits\Api_Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    use Api_Response;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
    protected function unauthenticated($request, array $guards)
    {
//        abort(response()->json(
//            [
//                'api_status' => '401',
//                'message' => 'UnAuthenticated',
//            ], 401));
        abort($this->apiResponse(null,401,'you are UnAuthenticated, please login first'));
    }
}
