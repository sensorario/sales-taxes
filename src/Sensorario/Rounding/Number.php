<?php

namespace Sensorario\Rounding;

final class Number
{
    private $cents;

    private function __construct($cents)
    {
        $this->cents = $cents;
    }

    public function fromValue($value)
    {
        return new self($value);
    }

    public function partsPercent($percent) {
        $number = $this->cents / 100 * $percent;

        return (int) $number;
    }

    public function value()
    {
        return $this->cents;
    }
}
