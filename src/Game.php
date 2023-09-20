<?php

namespace App;


class Game
{

    protected array $rolls = [];


    public function roll(int $pins)
    {
        return $this->rolls[] = $pins;
    }


    public function score()
    {
        return array_sum($this->rolls);
    }

}