<?php

namespace App\Core;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreatePlayer
{
    /**
     * @param $data
     * Creat a user and return user instance
     */
    public function __invoke($data)
    {
        $data['user_name'] = 'user';
        $data['password'] = Hash::make($data['password']);
        $data['registered_at'] = now();
        $player = User::create($data);
        $player->createToken('Personal Access Token');
        return $player;
    }
}
