<?php

namespace Tests\Dice;

use PHPUnit\Framework\TestCase;
use App\Models\Dice\Game;

class GameTest extends TestCase
{
    public int $playersNumber = 2;
    public int $dicesNumber = 2;
    protected $game;


    protected function setUp(): void
    {
        $this->game = new Game($this->playersNumber, $this->dicesNumber);
    }

    protected function tearDown(): void
    {
        $this->game = null;
    }

    public function testGameClassInit()
    {
        $this->assertInstanceOf("App\Models\Dice\Game", $this->game);
    }

    public function testdiceInHandsNumReturnString()
    {
        $this->game->playersProcess();
        $res = $this->game->diceInHandsNum();

        $this->assertIsString($res);
    }

    public function testthrowTheDice()
    {
        $this->game->playersProcess();
        $res = $this->game->diceInHandsNum();
        $this->game->throwTheDice();
        $res1 = $this->game->diceInHandsNum();

        $this->assertNotEquals($res, $res1);
    }

    public function testsumForHands()
    {
        $this->game->playersProcess();
        $res = $this->game->sumForHands();

        $this->assertIsString($res);
    }

    public function testplayer1()
    {
        $this->game->playersProcess();
        $playersHandsSum = $this->game->sumForHands();
        $player1 = $this->game->player1();

        $res = explode(', ', $playersHandsSum);

        if ($res[0] > $res[1]) {
            $this->assertEquals(1, $player1);
        } else if ($res[1] > $res[0]) {
            $this->assertEquals(2, $player1);
        } else if ($res[0] === $res[1]) {
            $this->assertEquals('Roll again', $player1);
        }
    }

    public function testplayButtonIsVisible()
    {
        $this->game->playersProcess();
        $this->game->sumForHands();
        $this->game->sumTheRound(1);
        $this->game->savePlayerResults(1);

        $res = $this->game->playButton();
        $this->assertEquals('visible', $res);
    }

    public function testNoWinner()
    {
        $this->game->playersProcess();
        $this->game->sumForHands();
        $this->game->sumTheRound(1);
        $this->game->savePlayerResults(1);

        $noWinner = $this->game->winner(1);

        $this->assertEquals('No winner yet!', $noWinner);
    }

    public function testTheNextOne()
    {
        $res = $this->game->TheNextOne(2);

        $this->assertEquals(1, $res);

        $res = $this->game->TheNextOne(1);

        $this->assertEquals(2, $res);

        $playerOutOfBoundary = 3;
        $res = $this->game->TheNextOne($playerOutOfBoundary);

        $this->assertFalse($res);
    }


    public function testdiceInHand()
    {
        $process = $this->game->playersProcess();
        $res = $this->game->diceInHand(1);

        $this->assertIsString($res);

        $toString = implode(', ', $process[0]);

        $this->assertEquals($toString, $res);
    }

    public function teststartTHeGame()
    {
        $this->game->playersProcess();
        $this->game->sumForHands();
        $player1 = $this->game->player1();
        $res = $this->game->StartPlayingAgain();

        if ($player1 == 'Roll again') {
            $this->assertIsInt($res);
        }
        $this->assertGreaterThan(0, $res);
    }
}
