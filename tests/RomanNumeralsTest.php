<?php

use PHPUnit\Framework\TestCase;
use App\PrimeFactors;

class RomanNumeralsTest extends TestCase
{
    /** @test */
    function it_generates_the_roman_numeral_for_1()
    {
        $this->assertEquals('I', RomanNumerals::generate(1));
    }
}