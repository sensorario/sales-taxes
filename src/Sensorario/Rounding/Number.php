<?php

namespace Sensorario\Rounding;

use Sensorario\Rounding\BaseClasses\CentValue;

final class Number extends CentValue
{
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
