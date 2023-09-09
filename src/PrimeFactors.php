<?php

namespace App;

class PrimeFactors 
{
    public function generate($number)
    {   
        $factors = [];
        
        for ($divider = 2; $number > 1; $divider++) {

            for (; $number % $divider == 0; $number /= $divider) {

                $factors[] = $divider;
            }

        }

        return $factors;

    }
}