<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends ApiController
{
    public function purchase(PurchaseRequest $request)
    {
        $user = User::where('token',$request->get('token'))->first();
        $itemIds = $request->get('item_ids');
        $amount = 0;

        foreach ($itemIds as $itemId){
            $amount += Item::find($itemId)->price;
        }

        if ($user->balance->balance < $amount){
            return $this->failResponse(433,"Low balance");
        }

        $user->items()->attach($itemIds);

        $user->balance()->update([
            'balance' => $user->balance->balance - $amount
        ]);


        return $this->successResponse();
    }
}
