<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $hasToken = User::find(2);
        return response()->json($hasToken);
//        if (!$hasToken){
//            return response()->json($hasToken);
//        }
//        return $next($request);
    }
}
