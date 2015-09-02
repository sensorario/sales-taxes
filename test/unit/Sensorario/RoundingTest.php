<?php

namespace Sensorario;

use PHPUnit_Framework_TestCase;

final class SomeTest extends PHPUnit_Framework_TestCase
{
    public function test1()
    {
        $money = Money::fromValue(11.25);

        $this->assertEquals(11.25, $money->price());
        $this->assertEquals(1125, $money->priceInCent());
        $this->assertEquals(6, $money->roundUpToPercent(5));
        $this->assertEquals('1,125.00', $money->roundUpToPercent(1000));
        $this->assertEquals(562.50, 1125/2);
        $this->assertEquals('563.00', $money->roundUpToPercent(500));
        $this->assertEquals(375.00, 1125/3);
        $this->assertEquals('375.00', $money->roundUpToPercent(333));
    }
}

final class Money
{
    private $price;

    private function __construct($price)
    {
        $this->price = $price;
    }

    public static function fromValue($price)
    {
        return new self($price);
    }

    public function price()
    {
        return $this->price;
    }

    public function priceInCent()
    {
        return $this->price * 100;
    }

    public function roundUpToPercent($percentage)
    {
        $value = $this->price * $percentage / 10;

        return number_format(
            ceil($value),
            2
        );
    }
}
