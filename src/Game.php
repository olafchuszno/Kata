<?php

namespace App;


class Game
{

    protected array $rolls = [];

    // pins variable holds the count of actual pins knocked
    protected array $pins = [];

    protected $bonus = 0;

    protected $addToBonus = 0;





    public function roll(int $pins)
    {
        // update the 'pins' array about the actual number of pins knocked
        $this->pins[] = $pins;


        // Check for STRIKE or SPARE
        if ($this->strike($pins)) {

            // It's' a STRIKE! Increment the addToBonus variable by 2
            $this->addToBonus += 2;

        } else if ($this->spare($pins)) {

            // It's a SPARE! Increment the addToBonus variable by 2
            $this->addToBonus += 1;
        }


        // Check whether bonus applies to this round
        if ($this->bonus > 0) {
            // Apply bonus to this roll's score
            $pins *= 2;

            // Decrement the bonus
            $this->bonus -= 1;
        }

        // Increment the bonus variable for next round/s
        $this->bonus += $this->addToBonus;
        
        // Reset addToBonus variable
        $this->addToBonus = 0;

        // Return the score for this roll
        return $this->rolls[] = $pins;
    }






    public function score()
    {
        return array_sum($this->rolls);
    }






    // STRIKE
    protected function strike(int $pins)
    {   
        // If it is the first out of the 2 throws
        if (count($this->rolls) == 0 || count($this->rolls) % 2 == 0) {

            // If all pins were knocked down at once
            if ($pins == 10) {

                return true;
            }
        }

        return false;
    }






    // SPARE
    protected function spare(int $pins)
    {
        // If it is the second out of the 2 throws
        if (count($this->rolls) != 0 && count($this->rolls) % 2 != 0) {

            // If all pins from the last round (2 throws)
            if (end($this->pins) + $pins == 10) {

                return true;
            }
        }

        return false;
    }

}