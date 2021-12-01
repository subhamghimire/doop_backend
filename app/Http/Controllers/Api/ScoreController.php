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
        $score = Score::create([
            'score' => $request->get('score'),
            'user_id' => auth()->user()->id,
        ]);

        return $this->successResponse($score,200);
    }

    public function highScore()
    {
        $highScore = Score::where('user_id', auth()->user()->id)->max('score');
        return $this->successResponse($highScore,200);
    }

    public function scoreBoard()
    {
        $scoreBoard = Score::where('user_id', auth()->user()->id)->orderBy('score', 'desc')->limit(5)->get();
        return $this->successResponse($scoreBoard,200);
    }

    public function leaderBoard()
    {
        $players = User::with('scores')->get();

        $result = [];

        foreach ($players as $player)
        {
            $result[] = [
                'score' => $player->scores->max('score'),
                'user' => $player->name
            ];
        }

        $r = collect($result)->filter((function ($score, $key) {
            return $score["score"] != null;
        }))->values()->all();

        return $this->successResponse($r,200);
    }
}
