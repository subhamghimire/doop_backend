<?php


namespace App\Http\Controllers\Auth;

use App\Core\CreatePlayer;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class RegisterController extends ApiController
{
    /**
     * Register a new user from signup link
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:4|max:20',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ];
        $response = $this->validateApiRequest($rules);
        if ($response !== true) {
            return $response;
        }
        $created = (new CreatePlayer())($request->all());
        if ($created){
            return $this->successResponse($created);
        }
        return $this->failResponse();
    }

}
