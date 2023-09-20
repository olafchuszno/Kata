<?php

use PHPUnit\Framework\TestCase;
use App\RomanNumerals;

class RomanNumeralsTest extends TestCase
{
    /** @test
     * @dataProvider checks
     */
    public function generate_the_roman_numeral($number, $numeral)
    {
        $this->assertEquals($numeral, RomanNumerals::generate($number));
    }

    public function checks()
    {
        return [
            [1, 'I'],
            [2, 'II']
        ];
    }
}