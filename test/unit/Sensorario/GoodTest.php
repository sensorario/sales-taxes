<?php

namespace Sensorario;

use PHPUnit_Framework_TestCase;

final class GoodTest extends PHPUnit_Framework_TestCase
{
    public function testTaxedGood()
    {
        $good = Good::create([
            'type'     => 'chocolate',
            'price'    => 11.25,
            'imported' => true
        ]);

        $this->assertEquals(
            11.85,
            $good->taxedPrice()
        );

        $this->assertTrue(
            $good->isImported()
        );

        $this->assertEquals(
            11.25,
            $good->price()
        );

        $this->assertEquals(
            6.00,
            $good->salesTax()
        );
    }

    public function testRoundingPrice()
    {
        $this->assertEquals(
            5.625,
            Good::priceToRound(11.25)
        );
    }

    public function testRoundingRule()
    {
        $this->assertEquals(
            6,
            Good::roundUpToTheNeares0_05(11.25)
        );
    }
}
