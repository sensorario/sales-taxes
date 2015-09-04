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

    public function partsPercent($perten) {
        $number = $this->cents / 100 * $perten;

        $result = ceil($number/10);

        if (($number - (int) $number) == 0.5) {
            $result -= 0.5;
        }

        return 0.1 * $result;
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
