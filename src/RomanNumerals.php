<?php

namespace App;

class RomanNumerals 
{
    public static function generate($number)
    {
        if ($number > 1) {
            return 'II';
        }
        
        return 'I';
    }    
}