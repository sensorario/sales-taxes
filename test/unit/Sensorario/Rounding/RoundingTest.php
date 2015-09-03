<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;

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

abstract class IntegerValue
{
    protected $cents;

    protected function __construct($cents)
    {
        $this->cents = $cents;
    }

    public static function fromNumber($number)
    {
        return new static($number * 100);
    }

    public static function fromCent($cents)
    {
        return new static($cents);
    }

    public function value()
    {
        return $this->cents;
    }

    abstract public function valuePercent($percent);
}

final class Money extends IntegerValue
{
    public function valuePercent($percent) {
        $number = $this->cents / 100 * $percent;

        return ceil($number/10);
    }
}

final class Number extends IntegerValue
{
    public function valuePercent($percent) {
        $number = $this->cents / 100 * $percent;

        return (int) $number;
    }
}
