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
        $hasToken = DB::table('users')->where('token','=', $token)->first();
        dd($hasToken);
        if (!$hasToken){
            return response()->json(['message'=>'Could not verify user!']);
        }
        return $next($request);
    }
}
