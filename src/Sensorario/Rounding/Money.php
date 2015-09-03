<?php

namespace Sensorario\Rounding;

use Sensorario\Rounding\IntegerValue;

final class Money extends IntegerValue
{
    public function valuePercent($percent) {
        $number = $this->cents / 100 * $percent;

        return ceil($number/10);
    }
}
