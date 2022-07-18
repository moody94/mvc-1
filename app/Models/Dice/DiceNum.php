<?php

namespace App\Models\Dice;

class DiceNum
{

    private $sides = 0;
    private $lastRoll = 0;


    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    public function roll(): int
    {
        $this->lastRoll = rand(1, $this->sides);
        return $this->lastRoll;
    }

    public function lastRoll(): int
    {
        return $this->lastRoll;
    }
}
