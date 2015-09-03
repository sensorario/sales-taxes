<?php

namespace Sensorario\Rounding;

use Sensorario\Rounding\Percentable;

abstract class IntegerValue implements Percentable
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

    abstract public function partsOverTen($percent);
}
