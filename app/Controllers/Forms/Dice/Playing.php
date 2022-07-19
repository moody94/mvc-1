<?php

namespace App\Controllers\Forms\Dice;

use Illuminate\Http\Request;

class Playing
{
    public function process(Request $request)
    {
        $play = $request->input('play');
        $reset = $request->input('reset');

        $game = $request->session()->get("game");

        if ($play) {
            if ($game->player1() == 'Roll again') {
                $game->throwTheDice();
                $request->session()->put('playersHands', $game->diceInHandsNum());
                $request->session()->put('sumForHands', $game->sumForHands());
                $request->session()->put('player1', $game->player1());
                $amoundOfPlayer = $request->session()->get('amoundOfPlayer');
                $dicesAmount = $request->session()->get('dicesAmount');
                return redirect("/play")->with('amoundOfPlayer', $amoundOfPlayer)->with('dicesAmount', $dicesAmount);
            }
            $whoWillPlay = $request->session()->get('player1');
            $game->playersProcess();
            $game->throwTheDice();
            $request->session()->put('diceInHand', $game->diceInHand($whoWillPlay));
            $request->session()->put('saveButton', 'visible');
            $request->session()->put('playButton', 'visible');
            $request->session()->put("sumForHands", $game->sumForHands());
            $request->session()->put("sumTheRound", $game->sumTheRound($whoWillPlay));
            $request->session()->put("winner", $game->winner($whoWillPlay));
            return redirect("/game");
        } elseif ($reset) {
            return redirect("/dice");
        }
    }
}
