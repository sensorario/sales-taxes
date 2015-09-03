<?php

namespace Sensorario\Rounding;

use Sensorario\Rounding\IntegerValue;

final class Money extends IntegerValue
{
    public function partsOverTen($percent) {
        $number = $this->cents / 100 * $percent;

        $ceil = ceil($number/10);

        if (($number - (int) $number) == 0.5) {
            return $ceil - 0.5;
        }

        return $ceil;
    }
}
