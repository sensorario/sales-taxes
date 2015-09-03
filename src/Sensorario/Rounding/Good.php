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

    public function partsOverTen($percent)
    {
        $money = Money::fromCent(
            $this->params['price'] * 100
        );

        return 0.1 * $money->partsOverTen($percent);
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
        if (in_array($this->params['type'], self::nonTaxedTypes())) {
            return false;
        }

        return true;
    }

    public function finalValue()
    {
        $price      = $this->price();

        $importDuty = $this->isImported() ? $this->importDuty() : 0 ;

        return $price + $importDuty + $this->salesTaxes();
    }

    public function importDuty()
    {
        return $this->partsOverTen(5);
    }

    public function salesTaxes()
    {
        return $this->isTaxed()
            ? $this->partsOverTen(10)
            : 0
        ;
    }

    public static function nonTaxedTypes()
    {
        return [
            'book',
            'food',
            'medicals'
        ];
    }
}
