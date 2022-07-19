<?php

namespace App\Controllers\Forms\Dice;

use Illuminate\Http\Request;

class Game
{
    public function process(Request $request)
    {
        $play = $request->input('Players');
        $reset = $request->input('reset');
        $save = $request->input('save');

        if ($play) {
            $game = $request->session()->get("game");
            $request->session()->put("player1", $game->startPlayingAgain());
            $whoWillPlay = $request->session()->get('player1');
            $game->playersProcess();
            $game->throwTheDice();
            $request->session()->put("diceInHand", $game->diceInHand($whoWillPlay));
            $game->sumForHands();
            $request->session()->put("sumTheRound", $game->sumTheRound($whoWillPlay));
            $request->session()->put("winner", $game->winner($whoWillPlay));
            $request->session()->put('saveButton', $game->saveButton('visible', $whoWillPlay));
            return redirect("/game");
        } elseif ($reset) {
            $request->session()->put('lastSum', null);
            return redirect("/dice");
        } elseif ($save) {
            $game = $request->session()->get("game");
            $whoWillPlay = $request->session()->get('player1');
            $game->savePlayerResults($whoWillPlay);
            $request->session()->put("lastSum", $game->lastSum());
            $request->session()->put("winner", $game->winner($whoWillPlay));
            $request->session()->put("diceInHand", $game->diceInHand($whoWillPlay));
            $request->session()->put('saveButton', $game->saveButton('save', $whoWillPlay));
            $request->session()->put('playButton', $game->playButton());
            return redirect("/game");
        }
    }
}
