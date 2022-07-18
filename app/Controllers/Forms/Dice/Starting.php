<?php

namespace App\Controllers\Forms\Dice;

use Illuminate\Http\Request;
use App\Models\Dice\Game;

class Starting
{
    public function process(Request $request)
    {
        $playersAmount = $request->input('playersAmount');
        $dicesAmount = $request->input('dicesAmount');

        $game = new Game($playersAmount, $dicesAmount);
        $request->session()->put('game', $game);

        $game->playersProcess();

        $playersHands = $game->diceInHandsNum();
        $request->session()->put("playersHands", $playersHands);
        $sumForHands = $game->sumForHands();
        $request->session()->put("sumForHands", $sumForHands);
        $request->session()->put("player1", $game->player1());

        return redirect('/play');
    }
}
