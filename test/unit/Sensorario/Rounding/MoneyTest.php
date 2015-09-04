<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;
use Sensorario\Rounding\Percentable;
use Sensorario\Rounding\Number;

final class MoneyTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $money = Money::fromNumber(11.25);
        $this->assertEquals(1125, $money->value());
        $this->assertEquals(6, $money->partsOverTen(5));
    }
}
