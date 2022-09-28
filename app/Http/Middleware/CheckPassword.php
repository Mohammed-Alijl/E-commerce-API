<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\Traits\Api_Response;
use Closure;
use Illuminate\Http\Request;

class CheckPassword
{
    use Api_Response;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->header('apiKey') != env('apiKey','p@ssword123'))
            return $this->apiResponse(null,401,'Wrong api Key');
        return $next($request);
    }
}
