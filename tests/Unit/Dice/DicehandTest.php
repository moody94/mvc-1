<?php

namespace Tests\Dice;

use App\Models\Dice\DiceHand;
use PHPUnit\Framework\TestCase;

class DiceHandTest extends TestCase
{
    public int $diceAmount = 2;

    public function testInitDiceHandClass()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("App\Models\Dice\DiceHand", $diceHand);
    }

    public function testchangeValues()
    {
        $diceHand = new DiceHand($this->diceAmount);

        $diceHand->setValues();
        $values = $diceHand->getValues();

        $this->assertNotEmpty($values);

        $diceHand->changeValues();

        $values = $diceHand->getValues();

        $this->assertEmpty($values);
    }

    public function testResetValues()
    {
        $diceHand = new DiceHand($this->diceAmount);

        $diceHand->setValues();
        $values = $diceHand->getValues();

        $this->assertCount(2, $values);

        $diceHand->ResetValues();
        $values = $diceHand->getValues();
        $this->assertCount(2, $values);

        $this->assertEquals($values, [0, 0]);
    }

    public function testTheSumMethod()
    {
        $diceHand = new DiceHand($this->diceAmount);

        $diceHand->setValues();

        $values = array_sum($diceHand->getValues());
        $valueOfSum = $diceHand->sum();

        $this->assertEquals($valueOfSum, $values);
    }

    public function testtheScoreinHand()
    {
        $diceHand = new DiceHand($this->diceAmount);

        $diceHand->setValues();

        $theScoreinHand = $diceHand->sum();
        $this->assertGreaterThan(0, $theScoreinHand);

        $resettheScoreinHand = $diceHand->resettheScoreinHand();

        $this->assertEquals(0, $resettheScoreinHand);
    }
}
