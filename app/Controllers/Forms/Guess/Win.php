<?php

namespace App\Controllers\Forms\Guess;

use Illuminate\Http\Request;

class Win
{
    public function process(Request $request)
    {
        $request->session()->put('guess', null);
        $request->session()->put('cheat', null);
        $request->session()->put('makeGuess', null);

        $init = $request->input('init');

        if ($init) {
            return redirect('/start-guess');
        }
    }
}
