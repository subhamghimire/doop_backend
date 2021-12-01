<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class LoginController extends ApiController
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return $this->failResponse();
        }
        $user = $request->user();
        $token = $user->createToken('Personal Access Token');

        return $this->successResponse([
            'user' => $user,
            'token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'access_token' => $token->accessToken,
        ], 200);
    }

    public function user()
    {
        $user = auth()->user();
        return response()->json([
            'access_token' => $user->currentAccessToken(),
            'token_type' => 'Bearer',
            'user' => $user,
            'success' => true
        ]);
    }

    /**
     * logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        Session::flush();
        return $this->successResponse("",200);
    }
}
