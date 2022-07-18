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
                $AmoundOfPlayer = $request->session()->get('AmoundOfPlayer');
                $dicesAmount = $request->session()->get('dicesAmount');
                return redirect("/play")->with('AmoundOfPlayer', $AmoundOfPlayer)->with('dicesAmount', $dicesAmount);
            }
            $playerRound = $request->session()->get('player1');
            $game->processthePlayersArrs();
            $game->throwTheDice();
            $request->session()->put('diceInHand', $game->diceInHand($playerRound));
            $request->session()->put('saveButton', 'visible');
            $request->session()->put('playButton', 'visible');
            $request->session()->put("sumForHands", $game->sumForHands());
            $request->session()->put("sumTheRound", $game->sumTheRound($playerRound));
            $request->session()->put("winner", $game->winner($playerRound));
            return redirect("/game");
        } elseif ($reset) {
            return redirect("/dice");
        }
    }
}
