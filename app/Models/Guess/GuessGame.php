<?php

namespace App\Models\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class GuessGame
{

    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->tries = $tries;
        if ($number === -1) {
            $number = rand(1, 100);
        }
        $this->number = $number;
    }


    public function random(): void
    {
        $number = rand(1, 100);
        $this->number = $number;
    }


    public function tries(): int
    {
        return $this->tries;
    }


    public function number(): int
    {
        return $this->number;
    }

    public function makeGuess(int $guess): string
    {

        $this->tries--;
        if ($this->tries < 0) {
            $this->tries = 0;
        }
        if ($guess < 1 || $guess > 100) {
            $res = "The given number is out of range.";
        } elseif ($guess === $this->number) {
            $res = "CORRECT";
        } elseif ($guess > $this->number) {
            $res = "TOO HIGH";
        } else {
            $res = "TOO LOW";
        }
        return $res;
    }
}
