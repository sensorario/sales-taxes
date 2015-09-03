<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;
use Sensorario\Rounding\Good;

final class GoodTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $good = Good::box([
            'price_in_cents' => 1125,
            'price' => 11.25
        ]);

        $this->assertEquals(
            1125,
            $good->priceInCents(5)
        );

        $this->assertEquals(
            6,
            $good->valuePercent(5)
        );
    }
}
