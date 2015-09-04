<?php

namespace Sensorario\Rounding\BaseClasses;

abstract class CentValue
{
    protected $cents;

    protected function __construct($cents)
    {
        $this->cents = $cents;
    }

    public static function fromCent($cents)
    {
        return new static($cents);
    }

    public function value()
    {
        return $this->cents;
    }
}
