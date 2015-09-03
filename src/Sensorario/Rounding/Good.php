<?php

namespace Sensorario\Rounding;

use Sensorario\Rounding\Percentable;
use Sensorario\Rounding\Money;

final class Good implements Percentable
{
    private $params;

    private function __construct(array $params)
    {
        $this->params = $params;
    }

    public function box(array $params)
    {
        return new self($params);
    }

    public function valuePercent($percent)
    {
        $money = Money::fromCent(
            $this->params['price'] * 100
        );

        return 0.1 * $money->valuePercent($percent);
    }

    public function isImported()
    {
        return $this->params['imported'];
    }

    public function price()
    {
        return $this->params['price'];
    }

    public function isTaxed()
    {
        return $this->params['type'] == 'perfume';
    }

    public function finalValue()
    {
        $price      = $this->price();

        $importDuty = 0;

        if ($this->isImported()) {
            $importDuty = $this->valuePercent(5);
        }

        $salesTaxes = 0;

        if ($this->isTaxed()) {
            $salesTaxes = $this->valuePercent(10);
        }

        return $price + $importDuty + $salesTaxes;
    }
}
