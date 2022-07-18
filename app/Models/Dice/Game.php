<?php

namespace App\Models\Dice;

class Game
{
    private $thePlayersArr = [];
    private $thePlayersValues = [];
    private $sumForHands = [];
    private $sumInTheRounds = [];
    private $lastSum = [];
    private $startTHeGame = 0;


    public function __construct(int $playersNumber, int $dicesAmount)
    {
        for ($i = 0; $i < $playersNumber; $i++) {
            array_push($this->thePlayersArr, new DiceHand($dicesAmount));
        }
    }


    public function playersProcess(): array
    {
        $playersNumber = count($this->thePlayersArr);
        for ($i = 0; $i < $playersNumber; $i++) {
            $diceHand = $this->thePlayersArr[$i];
            $diceHand->setValues();

            $dices = sizeof($diceHand->getValues());

            $playerArray = [];
            $playerArray[$i] = [];
            for ($j = 0; $j < $dices; $j++) {
                array_push($playerArray[$i], $diceHand->getValues()[$j]);
            }
            array_push($this->thePlayersValues, $playerArray[$i]);
        }
        return $this->thePlayersValues;
    }

    public function throwTheDice()
    {
        $playersNumber = count($this->thePlayersArr);
        $this->thePlayersValues = [];
        $this->sumForHands = [];

        for ($i = 0; $i < $playersNumber; $i++) {
            $this->thePlayersArr[$i]->changeValuesArray();
            $this->thePlayersArr[$i]->rollHand();
            $this->thePlayersArr[$i]->resetHandScore();

            $diceHand = $this->thePlayersArr[$i];
            $diceHand->setValues();

            $dices = sizeof($diceHand->getValues());

            $playerArray = [];
            $playerArray[$i] = [];
            for ($j = 0; $j < $dices; $j++) {
                array_push($playerArray[$i], $diceHand->getValues()[$j]);
            }
            array_push($this->thePlayersValues, $playerArray[$i]);
        }
        return $this->thePlayersValues;
    }


    public function diceInHandsNum()
    {
        $count = sizeof($this->thePlayersValues);
        $values1 = '';
        for ($i = 0; $i < $count; $i++) {
            $values1 .= "The player number: " . ($i + 1) .  '/   The Dice number: ' . implode(', ', $this->thePlayersValues[$i]) . '<br>';
        }
        return $values1;
    }


    public function sumForHands()
    {
        $playersNumber = count($this->thePlayersArr);
        $this->sumForHands = [];
        for ($i = 0; $i < $playersNumber; $i++) {
            array_push($this->sumForHands, $this->thePlayersArr[$i]->sum());
        }
        $sumForHands = implode(', ', $this->sumForHands);
        return $sumForHands;
    }

    public function player1()
    {
        $max = max($this->sumForHands);
        $itemsInPlayerSum = count($this->sumForHands);

        $rep = 0;
        for ($i = 0; $i < $itemsInPlayerSum; $i++) {
            if ($max) {
                if ($max == $this->sumForHands[$i]) {
                    $rep++;
                }
            }
        }

        $startTHeGame = array_search($max, $this->sumForHands) + 1;
        if ($rep > 1) {
            return 'Roll again';
        }
        $this->startTHeGame = $startTHeGame;
        return $this->startTHeGame;
    }
    public function checkSumInHand(int $player): bool
    {
        if (in_array(1, $this->thePlayersValues[$player - 1])) {
            return true;
        };
        return false;
    }

    public function diceInHand(int $player)
    {
        $diceInHandValuesArr = $this->thePlayersValues[$player - 1];
        $diceInHandValues = implode(', ', $diceInHandValuesArr);
        return $diceInHandValues;
    }

    public function TheNextOne(int $player)
    {
        $AmoundOfPlayer = count($this->thePlayersArr);

        if ($player <= $AmoundOfPlayer && $player > 0) {
            if ($player === $AmoundOfPlayer) {
                $this->startTHeGame = 1;
                return $this->startTHeGame;
            } elseif ($player < $AmoundOfPlayer && $player > 0) {
                $this->startTHeGame = $player + 1;
                return $this->startTHeGame;
            } else return false;
        }
        return false;
    }

    public function StartPlayingAgain()
    {
        return $this->startTHeGame;
    }

    public function sumTheRound(int $player)
    {
        $roundSum = 0;
        if (array_key_exists($player - 1, $this->sumInTheRounds)) {
            $roundSum = $this->sumInTheRounds[$player - 1];
        }

        if ($this->checkSumInHand($player) === true) {
            $this->sumInTheRounds[$player - 1] = 0;
            $this->sumForHands[$player - 1] = 0;
            $this->TheNextOne($player);
            return $this->sumInTheRounds[$player - 1];
        } else if ($this->checkSumInHand($player) === false) {
            $roundSum += $this->sumForHands[$player - 1];
            $this->sumInTheRounds[$player - 1] = $roundSum;
            if ($this->sumInTheRounds) {
                if ($this->sumInTheRounds[$player - 1] < 100) {
                    return $this->sumInTheRounds[$player - 1];
                }
                return 'bigger than 100';
            }
        }
    }

    public function savePlayerResults(int $player)
    {
        if (array_key_exists($player - 1, $this->lastSum)) {
            $this->lastSum[$player - 1] += $this->sumInTheRounds[$player - 1];
        } else {
            $this->lastSum[$player - 1] = $this->sumInTheRounds[$player - 1];
        }

        return $this->TheNextOne($player);
    }

    public function lastSum()
    {
        $keys = array_keys($this->lastSum);
        $arrayLength = count($keys);

        $res = '';
        for ($i = 0; $i < $arrayLength; $i++) {
            $res .= 'Player ' .  ($keys[$i] + 1) . "'s score is: " . $this->lastSum[$keys[$i]]
                . ' <br>';
        }
        return $res;
    }

    public function winner(int $player)
    {
        $lastSumCount = count($this->lastSum);
        if ($lastSumCount > 0) {
            if (array_key_exists($player - 1, $this->lastSum)) {
                if ($this->lastSum[$player - 1] < 100) {
                    return 'No winner yet!';
                }
                return 'Player ' . $player . ' wins! :)';
            }
        }
        return 'No winner yet!';
    }

    public function saveButton(string $case, int $player)
    {
        if ($case == 'save') {
            if (array_key_exists($player - 1, $this->sumInTheRounds)) {
                $this->sumInTheRounds[$player - 1] = 0;
            }

            if ($this->checkSumInHand($player) === true) {
                return 'none';
            }
            return 'none';
        } else if ($case == 'visible') {
            if ($this->checkSumInHand($player) === true) {
                return 'none';
            }
            return 'visible';
        }
        return $this->oneWhenSave($player);
    }
    public function oneWhenSave(int $player): string
    {
        if ($this->checkSumInHand($player) === true) {
            return 'none';
        }
        return 'visible';
    }

    public function playButton(): string
    {
        if (max($this->lastSum) >= 100) {
            return 'none';
        }
        return 'visible';
    }
}
