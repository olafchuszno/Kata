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

            $first_roll = $this->rolls[$roll];
            $second_roll = $this->rolls[$roll + 1];

            // If it is the last frame
            if ($frame == 10) {

                // Update this frame's pins
                $this_frames_pins = $first_roll + $second_roll;

                // If there was a third roll in this frame
                if (isset($this->rolls[$roll+2])) {

                    // Add pins from the third roll
                    $this_frames_pins += $this->rolls[$roll + 2];
                }


                // ! There are no bonuses to calculate in the last frame, update final score & break

                // Update the score
                $score += $this_frames_pins;

                break;

                // if there was a strike NOW (and it's before the 9th frame)
            } elseif ($this->strike($first_roll, $frame)) {

                // if there is a strike in the next frame
                if ($this->rolls[$roll + 2] == 10) {

                    $this_frames_pins = 30;
                    
                    // if there is NOT a strike in the next frame
                } else {

                    // Add the bonus pins
                    $this_frames_pins = 10 + $this->rolls[$roll + 1] + $this->rolls[$roll + 2];
                }

                $roll += 1;

                // if there was a spare NOW (and it's before the 9th frame)
            } elseif ($this->spare($first_roll, $second_roll, $frame)) {

                // Add the bonus pins
                $this_frames_pins = 10 + $this->rolls[$roll + 2];

                // Increment the roll after counting this frames's results
                $roll += 2;

                // There was neither a strike nor a spare
            } else {

                $this_frames_pins = $first_roll + $second_roll;

                // Increment the roll after counting this frames's results
                $roll += 2;
            }

            // Update the score
            $score += $this_frames_pins;

        }
            
        return $score;
    }


    protected function strike($first_roll, $frame)
    {
        if ($first_roll == 10 && $frame < 9) {
            return true;
        }

        return false;
    }

    protected function spare($first_roll, $second_roll, $frame)
    {
        if ($first_roll + $second_roll == 10 && $frame < 9) {
            return true;
        }

        return false;
    }

}


