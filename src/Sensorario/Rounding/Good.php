<?php

namespace Sensorario\Rounding;

use Sensorario\Rounding\Money;

final class Good
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

    public function isTaxed()
    {
        if (in_array($this->params['type'], self::nonTaxedTypes())) {
            return false;
        }

        return true;
    }

    public function finalValue()
    {
        $price = $this->getPropery('price');

        $importDuty = $this->getPropery('imported') ? $this->importDuty() : 0 ;

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

    public function getPropery($propertyName)
    {
        return $this->params[$propertyName];
    }
}
