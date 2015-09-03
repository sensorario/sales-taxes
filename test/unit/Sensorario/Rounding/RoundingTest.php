<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;
use Sensorario\Rounding\Percentable;
use Sensorario\Rounding\Number;

final class RoundingTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $money = Money::fromNumber(11.25);
        $this->assertEquals(1125, $money->value());
        $this->assertEquals(6, $money->valuePercent(5));

        $money = Number::fromCent(1125);
        $this->assertEquals(1125, $money->value());
        $this->assertEquals(56, $money->valuePercent(5));

        $money = Number::fromCent(100);
        $this->assertEquals(5, $money->valuePercent(5));
    }
}
