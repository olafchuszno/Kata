<?php

use App\RomanNumbers;
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

    /** @test */
    public function it_cannot_generate_a_roman_numeral_for_less_than_1()
    {
        $this->assertFalse(RomanNumerals::generate(0));
    }

    /** @test */
    public function it_cannot_generate_a_roman_numeral_for_more_than_4000()
    {
        $this->assertFalse(RomanNumerals::generate(4001));
    }

    public static function checks()
    {
        return [
            [1, 'I'],
            [2, 'II'],
            [3, 'III'],
            [10, 'X'],
            [49, 'XLIX'],
            [100, 'C'],
            [400, 'CD'],
            [500, 'D'],
            [900, 'CM'],
            [1499, 'MCDXCIX'],
            [2999, 'MMCMXCIX']
        ];
    }
}