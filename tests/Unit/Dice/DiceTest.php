<?php

namespace Tests\Dice;

use PHPUnit\Framework\TestCase;
use App\Models\Dice\DiceNum;

class DiceTest extends TestCase
{
    public function testLastRollZero()
    {
        $dice = new DiceNum(1);

        $lastRoll = $dice->lastRoll();
        $expected = 0;

        $this->assertEquals($lastRoll, $expected);
    }

    public function testLastRoll()
    {
        $dice = new DiceNum(1);

        $dice->roll();

        $lastRoll = $dice->lastRoll();
        $expected = 1;

        $this->assertEquals($lastRoll, $expected);
    }
}
