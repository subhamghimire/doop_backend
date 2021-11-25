<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScoreController extends ApiController
{
    public function score(Request $request)
    {
        $score = Score::create([
           'score' => $request->get('score'),
           'user_id' => auth()->user()->id,
        ]);

        return $this->successResponse($score,200);
    }

    public function highScore()
    {
        $highScore = Score::where('user_id',auth()->user()->id)->max('score');
        return $this->successResponse($highScore,200);
    }
}
