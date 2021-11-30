<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BalanceRechargeRequest;
use App\Models\Balance;
use App\Models\User;
use Illuminate\Http\Request;

class BalanceController extends ApiController
{
    public function recharge(BalanceRechargeRequest $request)
    {
        $user = User::where('token', $request->get('token'))->first();
        $balance = Balance::where('user_id', $user->id)->first();
        if (!$balance){
            Balance::create([
                'user_id' => $user->id,
                'balance' => $request->get('balance')
            ]);
        }else{
            $balance->update(['balance' => $balance->balance + $request->get('balance')]);
        }

        return $this->successResponse($balance,200);
    }
}
