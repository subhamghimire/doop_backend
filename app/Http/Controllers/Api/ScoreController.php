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
        $players = User::withMax('scores', 'score')
            ->whereNotNull('scores_max_score')
            ->orderBy('scores_max_score', 'desc')
            ->limit(5)
            ->get();

        $result = [];

        foreach ($players as $key=>$player)
        {
            $result[] = [
                'position' => $key+1,
                'score' => $player->scores_max_score ?? 0,
                'user' => $player->name
            ];
        }
        return $this->successResponse($result,200);
    }
}
