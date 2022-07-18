<?php

namespace App\Controllers\Tables\Dice;

use App\Models\Dice\DiceResults;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DiceGame extends Controller
{
    public function index()
    {
        $diceResults = DB::table('diceresults')->get();

        return view('diceGame.scores.display', ['diceresults' => $diceResults]);
    }
    public function store(Request $request)
    {
        $diceResults = new DiceResults();

        echo 'PHP is Fun!';
        if ($request->session()->get("winner") !== 'No winner yet!') {
            echo 'PHP is Fun123!';
            $score = $request->session()->get('lastSum');
            $scoreResult = str_replace('<br>', ' ', $score);

            $diceResults->winner = (string) $request->session()->get("winner");
            $diceResults->score = $scoreResult;
            // $diceResults->score = "scoreResult";

            $diceResults->save();
        }
        return redirect("/game");
    }
}
