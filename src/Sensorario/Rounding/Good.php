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

    public function finalValue()
    {
        $price      = $this->price();
        $salesTaxes = $this->valuePercent(5);

        return $price + $salesTaxes;
    }
}
