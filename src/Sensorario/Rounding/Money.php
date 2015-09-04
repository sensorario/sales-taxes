<?php

namespace Sensorario\Rounding;

use Sensorario\Rounding\BaseClasses\CentValue;

final class Money extends CentValue
{
    public static function fromFloat($number)
    {
        return new static($number * 100);
    }

    public function partsOverTen($percent) {
        $number = $this->cents / 100 * $percent;

        $ceil = ceil($number/10);

        if (($number - (int) $number) == 0.5) {
            return $ceil - 0.5;
        }

        return $ceil;
    }
}
