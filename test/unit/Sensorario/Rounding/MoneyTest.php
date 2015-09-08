<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;
use Sensorario\Rounding\Percentable;
use Sensorario\Rounding\Number;

final class MoneyTest extends PHPUnit_Framework_TestCase
{
    public function testGivenAFloatValueCouldReturnSameValueInCents()
    {
        $money = Money::fromFloat(11.25);
        $this->assertEquals(1125, $money->valueInCents());
    }

    public function testShouldThePercentValueAmount()
    {
        $money = Money::fromFloat(11.25);
        $this->assertEquals(0.6, $money->partsPercent(5));
    }
}
