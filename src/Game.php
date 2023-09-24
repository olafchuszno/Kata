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

        $bonus = 0;

        
        foreach (range(1, static::FRAMES_PER_GAME) as $frame) {

            $strike = false;

            $first_roll = $this->rolls[$roll];
            $second_roll = $this->rolls[$roll + 1];

            // If it is the last frame
            if ($frame == 10) {

                $this_frames_pins = $first_roll + $second_roll;

                if (isset($this->rolls[$roll+2])) {

                    $this_frames_pins += $this->rolls[$roll + 2];
                }

                // Update the score
                $score += $this_frames_pins;

                break;

                // if there was a strike NOW
            } elseif ($first_roll == 10) {

                $strike = true;

                if ($bonus > 0) {

                    $this_frames_pins = 20;

                    $bonus = 0;

                } else {

                    $this_frames_pins = 10;
                }

            } else {

                // if there's was a strike in the previous frame
                if ($bonus == 2) {

                    // Apply the bonus to the current frame
                    $this_frames_pins = ($first_roll + $second_roll) * 2;

                    // Decrement the bonus for future rounds
                    $bonus = 0;

                } elseif ($bonus == 1) {

                    // there was a spare in the previous frame

                    // Apply the bonus to the current frame's first roll
                    $this_frames_pins = ($first_roll) * 2 + $second_roll;

                    // Decrement the bonus for future rounds
                    $bonus = 0;

                } else {

                    // There is no bonus

                    $this_frames_pins = $first_roll + $second_roll;

                }

            }


            // Update the score
            $score += $this_frames_pins;

            if ($strike) {

                $bonus = 2;
            }

            // If there was a spare in this frame increase the bonus for the following roll
            if ($first_roll + $second_roll == 10) {

                // It's a spare
                $bonus = 1;
            }

            // Increment the roll after counting this frames's results
            if ($strike) {
                $roll += 1;

            } else {
                $roll += 2;
            }

        }
            
        return $score;
    }

}


