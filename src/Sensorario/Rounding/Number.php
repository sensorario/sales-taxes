<?php

namespace Sensorario\Rounding;

use Sensorario\Rounding\BaseClasses\CentValue;

final class Number extends CentValue
{
    public function partsOverTen($percent) {
        $number = $this->cents / 100 * $percent;

        return (int) $number;
    }
}
