<?php

namespace Tests\Dice;

use PHPUnit\Framework\TestCase;
use App\Models\Guess\GuessGame;
use App\Models\Guess\GuessException;

class GuessTest extends TestCase
{
    protected $game;

    protected function setUp() : void
    {
        $this->game = new GuessGame(50, 3);
    }

    protected function tearDown(): void
    {
        $this->game = null;
    }

    public function testGuessClassInit()
    {
        $this->assertInstanceOf("App\Models\Guess\Guess", $this->game);
    }

    public function testCheckGuess()
    {
        $res = $this->game->checkGuess(10);

        $this->assertIsString($res);
        $this->assertEquals($res, 'TOO LOW');

        $res = $this->game->checkGuess(45);
        $this->assertEquals($res, 'TOO HIGH');

        $res = $this->game->checkGuess(43);
        $this->assertEquals($res, 'CORRECT');

    }

    public function testCheckNumberMethod()
    {
        $this->game = new GuessGame(-2, 3);

        $res = $this->game->number();
        $this->assertNotEquals($res, 48);


        $this->game = new GuessGame(50, 3);
        $res = $this->game->number();

        $this->assertEquals($res, 50);

    }

    public function testMakeGuessRaiseExeption()
    {
        $this->expectException(GuessException::class);
        $res = $this->game->makeGuess(101, new GuessException("The given number is out of range."));
        $this->assertEquals($res, 'The given number is out of range');
    }

    public function testMakeGuess()
    {
        $res = $this->game->makeGuess(100);
        $this->assertEquals($res, 'TOO HIGH');
    }

    public function testTries()
    {
        $res = $this->game->tries();
        $this->assertEquals($res, 3);
        $this->assertNotEquals($res, 7);
        $this->game->tries();
        $this->game->tries();
        $this->game->tries();
        $this->game->tries();
        $this->game->tries();
        $res = $this->game->tries();
        $this->assertEquals($res, 0);
    }
}
