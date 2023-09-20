<?php

use App\Game;
use PHPUnit\Framework\TestCase;

/*
    - The goal is to knock down all ten pins
    - Each frame consists of throwing the ball twice to knock down all the pins
    - If you knock down all the pins with the first ball, it is called a "strike"
    - If you knock down all the pins with the second ball, it is called a "spare"
    - Each games consists of ten frames. If you bowl a strike in the tenth frame, you get two more balls. If you throw a spare, you get one more ball.
    - Scoring is based on the number of pins you knock down.
    However, if you bowl a spare, you get to add the pins in your next ball to that frame. For strikes, you get the next two balls.

    1. A game
    2. consists of 10 frames
    3. each frame has 1-2 rolls 
        if you throw less than 10 points, you get a second throw
    4. Check for strike and spare and apply (strike to 2 next throws), (spare to 1 next throw)
    5. If on the 10th throw you get a 'strike' you get 2 more throws
    6. If on the 10th throw you get a 'spare' you get 1 more throw

*/



class GameTest extends TestCase
{

    /** @test */
    public function it_scores_a_gutter_game_as_0()
    {
        $game = new Game();

        foreach (range(1, 20) as $roll) {
            $game->roll(0);
        }

        $this->assertSame(0, $game->score());

    }

    /** @test */
    public function it_awards_a_one_roll_bonus_for_every_spare()
    {
        $game = new Game();

        $game->roll(5);
        $game->roll(5);

        $game->roll(8);

        $game->roll(1);

        $game->roll(10);

        $game->roll(4);
        $game->roll(4);

        // foreach (range(1, 17) as $roll) {
        //     $game->roll(1);
        // }

        $this->assertEquals(53, $game->score());

    }

}