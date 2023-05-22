<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $_COOKIE['jwt'];
            $user = JWTAuth::setToken($token)->toUser();
            if ($user->role === 1) {
                return $next($request);
            }
        } catch (\Throwable $e) {
            return abort(404);
        }
        return abort(404);
    }
}
