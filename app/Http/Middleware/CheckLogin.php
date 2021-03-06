<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class CheckLogin
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
        if(!Auth::guard()->user()){
            return response()->json(['message' => 'You are not Logged In'], 401);
        }

        if(Auth::guard()->user()->role !== '2')
        {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
