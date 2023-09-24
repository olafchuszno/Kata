<?php

namespace App;


class Game
{
    const FRAMES_PER_GAME = 10;

    protected $rolls = [];


    public function roll(int $pins)
    {
        $this->rolls[] = $pins;
    }


    public function score()
    {
        $score = 0;

        $roll = 0;
        
        foreach (range(1, static::FRAMES_PER_GAME) as $frame) {

            if ($frame == 11) {
                break;
            }

            $first_roll = $this->rolls[$roll];
            $second_roll = $this->rolls[$roll + 1];

            // If it is the last frame
            if ($frame == 10) {

                // Update this frame's pins
                $score += $first_roll + $second_roll;

                // If you scored a strike or a spare in this frame
                if ($this->strike($first_roll) || $this->spare($first_roll, $second_roll)) {

                    // Add pins from the third roll
                    $score += $this->rolls[$roll + 2];
                }
                
                // End of the game


                // if there was a strike NOW
            } elseif ($this->strike($first_roll, $frame)) {

                // Add the bonus pins
                $score += 10 + $this->rolls[$roll + 1] + $this->rolls[$roll + 2];

                $roll += 1;

                // if there was a spare NOW
            } elseif ($this->spare($first_roll, $second_roll, $frame)) {

                // Add the bonus pins
                $score += 10 + $this->rolls[$roll + 2];

                // Increment the roll after counting this frames's results
                $roll += 2;

                // There was neither a strike nor a spare
            } else {

                $score += $first_roll + $second_roll;

                // Increment the roll after counting this frames's results
                $roll += 2;
            }

        }
            
        return $score;
    }


    protected function strike($first_roll)
    {
        if ($first_roll == 10) {
            return true;
        }

        return false;
    }

    protected function spare($first_roll, $second_roll)
    {
        if ($first_roll + $second_roll == 10) {
            return true;
        }

        return false;
    }

}