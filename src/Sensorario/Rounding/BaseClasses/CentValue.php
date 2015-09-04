<?php

namespace Sensorario\Rounding\BaseClasses;

abstract class CentValue
{
    protected $cents;

    protected function __construct($cents)
    {
        $this->cents = $cents;
    }
}
