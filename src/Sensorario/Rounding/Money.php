<?php

namespace Sensorario\Rounding;

final class Money
{
    private $cents;

    private function __construct($cents)
    {
        $this->cents = $cents;
    }

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

    public function valueInCents()
    {
        return $this->cents;
    }

    public static function fromCent($cents)
    {
        return new static($cents);
    }
}
