<?php

namespace Sensorario\Rounding;

use Sensorario\Rounding\Money;

final class Good
{
    private $attributes;

    private function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function box(array $attributes)
    {
        return new self($attributes);
    }

    public function partsPercent($percent)
    {
        $money = Money::fromCent(
            $this->attributes['price'] * 100
        );

        return 0.1 * $money->partsOverTen($percent);
    }

    public function isTaxed()
    {
        if (in_array($this->attributes['type'], self::nonTaxedTypes())) {
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
        return $this->partsPercent(5);
    }

    public function salesTaxes()
    {
        return $this->isTaxed()
            ? $this->partsPercent(10)
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
        return $this->attributes[$propertyName];
    }
}
