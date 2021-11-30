<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class HasTokenMiddleware
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
        $token = $request->get('token');
        if (!$token){
            return response()->json(['message'=>'Token doesnot exists!']);
        }
        $hasToken = User::where('token', "d85cf26e4800ce6f88dc5436d5da4d90")->first();
        return response()->json($hasToken);

        if (!$hasToken){
            return response()->json(['message'=>'Could not verify user!']);
        }
        return $next($request);
    }
}
