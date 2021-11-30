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
        $hasToken = User::where('token', $request->get("token"))->first();
        if (!$hasToken)
        {
            return response()->json(['message'=>'Link doesnot exists!']);
        }
        return $next($request);
    }
}
