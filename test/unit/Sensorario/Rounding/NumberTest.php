<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;
use Sensorario\Rounding\Percentable;
use Sensorario\Rounding\Number;

final class NumberTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $money = Number::fromCent(1125);
        $this->assertEquals(1125, $money->value());
        $this->assertEquals(56, $money->partsOverTen(5));

        $money = Number::fromCent(100);
        $this->assertEquals(5, $money->partsOverTen(5));
    }
}
