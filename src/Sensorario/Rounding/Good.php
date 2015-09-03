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

    public function priceInCents()
    {
        return $this->params['price_in_cents'];
    }

    public function valuePercent($percent)
    {
        $money = Money::fromNumber($this->params['price']);

        return $money->valuePercent($percent);
    }
}
