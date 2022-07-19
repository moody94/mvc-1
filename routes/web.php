<?php

use App\Controllers\Forms\Dice\Game;
use App\Controllers\Forms\Dice\Playing;
use App\Controllers\Forms\Dice\Starting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Controllers\Forms\Guess\Guesses;
use App\Controllers\Forms\Guess\Win;
use App\Controllers\Forms\Guess\Fail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/home', function () {
    return view('welcome');
})->name('home');


Route::get('/dice', function (Request $request) {
    $request->session()->put('lastSum', null);
    return view('diceGame/dice');
})->name('dice');

Route::post('/dice', [Starting::class, 'process'])->name('starting');

Route::get('/play', function () {
    return view('diceGame/play');
})->name('play');

Route::post('/play', [Playing::class, 'process'])->name('play');

Route::get('/game', function (Request $request) {
    $game = $request->session()->get("game");
    $request->session()->put("firstPlayer1", $game->StartPlayingAgain());

    return view('diceGame/game');
})->name('game');

Route::post('/game', [Game::class, 'process'])->name('game');


Route::get('/start-guess', function () {
    return view('guessGame/startGame');
})->name('start-guess');

Route::post('/start-guess', [Guesses::class, 'index'])->name('start-guess');


Route::get('/play-guess', function () {
    return view('guessGame/play');
})->name('play-guess');

Route::post('/play-guess', [Guesses::class, 'process'])->name('play-guess');


Route::get('/win-guess', function () {
    return view('guessGame/win');
})->name('win-guess');

Route::post('/win-guess', [Win::class, 'process'])->name('win-guess');


Route::get('/fail-guess', function () {
    return view('guessGame/lose');
})->name('fail-guess');

Route::post('/fail-guess', [Fail::class, 'process'])->name('fail-guess');
