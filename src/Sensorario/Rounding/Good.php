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

    public function withAttributes(array $attributes)
    {
        return new self($attributes);
    }

    public function valueInPercentage($percent)
    {
        $money = Money::fromCent(
            $this->attributes['price'] * 100
        );

        return $money->partsPercent($percent);
    }

    public function isTaxable()
    {
        return !$this->isntTaxable();
    }

    public function finalValue()
    {
        $price = $this->getPropery('price');

        $importDuty = $this->getPropery('imported') ? $this->importDuty() : 0 ;

        return $price + $importDuty + $this->salesTaxes();
    }

    public function importDuty()
    {
        return $this->valueInPercentage(5);
    }

    public function salesTaxes()
    {
        return $this->isTaxable()
            ? $this->valueInPercentage(10)
            : 0
        ;
    }

    public function getPropery($propertyName)
    {
        return $this->attributes[$propertyName];
    }

    public function isntTaxable()
    {
        $type = $this->getPropery('type');

        return in_array($type, ['book', 'food', 'medicals']);
    }
}
