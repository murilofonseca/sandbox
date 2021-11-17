<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class apiProtectedRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json(['status' => 'Token is Invalid'], 403);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => 'Unauthorized'], 403);
            } else {
                return response()->json(['status' => 'Authorization Token not Found'], 404);
            }
        }
        return $next($request);
    }
}
