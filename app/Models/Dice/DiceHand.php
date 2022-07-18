<?php

namespace App\Models\Dice;

class DiceHand
{
    private $dices = [];
    private $values = [];
    private $diceAmount = 0;
    private $handScore = 0;


    public function __construct(int $diceAmount = 5)
    {
        $this->diceAmount = $diceAmount;

        for ($i = 0; $i < $this->diceAmount; $i++) {
            $dice = new DiceNum();
            array_push($this->dices, $dice);
        }
    }

    public function rollHand()
    {
        for ($i = 0; $i < $this->diceAmount; $i++) {
            $this->dices[$i]->roll();
        }
    }

    public function setValues()
    {
        $this->rollHand();
        for ($i = 0; $i < $this->diceAmount; $i++) {
            $dice = $this->dices[$i];
            array_push($this->values, $dice->lastRoll());
        }
    }

    public function getValues()
    {
        return $this->values;
    }

    public function changeValuesArray()
    {
        $this->values = [];
        return $this->values;
    }

    public function resetValuesArray()
    {
        $count = count($this->values);

        for ($i = 0; $i < $count; $i++) {
            $this->values[$i] = 0;
        }
        return $this->values;
    }

    public function sum()
    {
        for ($i = 0; $i < $this->diceAmount; $i++) {
            $this->handScore += $this->values[$i];
        }
        $this->values = [];
        return $this->handScore;
    }

    public function resetHandScore()
    {
        $this->handScore = 0;
        return $this->handScore;
    }
}
