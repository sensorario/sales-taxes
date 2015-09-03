<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;
use Sensorario\Rounding\IntegerValue;

final class MoneyTest extends PHPUnit_Framework_TestCase
{
    public function testNormalPercentage()
    {
        $money = Money::fromNumber(23.75);

        $this->assertEquals(
            1.1875,
            23.75 * 5 / 100
        );

        $this->assertEquals(
            12,
            $money->partsOverTen(5)
        );
    }
}

