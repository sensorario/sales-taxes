<?php

namespace Sensorario\Rounding;

final class Number
{
    private $value;

    private function __construct($value)
    {
        $this->value = $value;
    }

    public function fromValue($value)
    {
        return new self($value);
    }

    public function partsPercent($percent) {
        $number = $this->value / 100 * $percent;

        return (int) $number;
    }

    public function value()
    {
        return $this->value;
    }
}
