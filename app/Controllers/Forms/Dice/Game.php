<?php

namespace App\Controllers\Forms\Dice;

use App\Controllers\Tables\Dice\DiceGame;
use Illuminate\Http\Request;

class Game
{
    public function process(Request $request)
    {
        $play = $request->input('Players');
        $reset = $request->input('reset');
        $save = $request->input('save');
        $diceGame = new DiceGame();
        if ($play) {
            $game = $request->session()->get("game");
            $request->session()->put("player1", $game->StartPlayingAgain());
            $playerRound = $request->session()->get('player1');
            $game->processthePlayersArrs();
            $game->throwTheDice();
            $request->session()->put("diceInHand", $game->diceInHand($playerRound));
            $game->sumForHands();
            $request->session()->put("sumTheRound", $game->sumTheRound($playerRound));
            $request->session()->put("winner", $game->winner($playerRound));
            $request->session()->put('saveButton', $game->saveButton('visible', $playerRound));
            return redirect("/game");
        } elseif ($reset) {
            $request->session()->put('lastSum', null);
            return redirect("/dice");
        } elseif ($save) {
            $game = $request->session()->get("game");
            $playerRound = $request->session()->get('player1');
            $game->savePlayerResults($playerRound);
            $request->session()->put("lastSum", $game->lastSum());
            $request->session()->put("winner", $game->winner($playerRound));
            $request->session()->put("diceInHand", $game->diceInHand($playerRound));
            $request->session()->put('saveButton', $game->saveButton('save', $playerRound));
            $request->session()->put('playButton', $game->playButton());

            $diceGame->store($request);
            return redirect("/game");
        }
    }
}
