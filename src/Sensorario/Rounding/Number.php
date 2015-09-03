<?php

namespace Sensorario\Rounding;

use Sensorario\Rounding\IntegerValue;

final class Number extends IntegerValue
{
    public function valuePercent($percent) {
        $number = $this->cents / 100 * $percent;

        return (int) $number;
    }
}
