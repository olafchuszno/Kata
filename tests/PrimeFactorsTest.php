<?php


use App\PrimeFactors;
use PHPUnit\Framework\TestCase;

class PrimeFactorsTest extends TestCase 
{
    /** @test */
    function it_generates_prime_factors_for_1()
    {
        $factors = new PrimeFactors();

        $this->assertEquals([], $factors->generate(1));
    }
}