<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScoreController extends ApiController
{
    public function score(Request $request)
    {
        $user = User::where('token', $request->get('token'))->first();
        $score = Score::create([
           'score' => $request->get('score'),
           'user_id' => $user->id,
        ]);

        return $this->successResponse($score,200);
    }

    public function highScore(Request $request)
    {
        $user = User::where("token", '=', $request->get('token'))->first();
        $highScore = Score::where('user_id', $user->id)->max('score');
        return $this->successResponse($highScore,200);
    }
}
