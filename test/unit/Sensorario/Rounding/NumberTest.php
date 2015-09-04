<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;
use Sensorario\Rounding\Percentable;
use Sensorario\Rounding\Number;

final class NumberTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $number = Number::fromValue(1125);
        $this->assertEquals(1125, $number->value());
        $this->assertEquals(56, $number->partsPercent(5));

        $number = Number::fromValue(100);
        $this->assertEquals(5, $number->partsPercent(5));
    }
}
