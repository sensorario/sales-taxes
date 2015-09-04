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

    public function getPropery($propertyName)
    {
        return $this->attributes[$propertyName];
    }

    public function withAttributes(array $attributes)
    {
        return new self($attributes);
    }

    public function isTaxable()
    {
        return !$this->isntTaxable();
    }

    public function isntTaxable()
    {
        $type = $this->getPropery('type');

        return in_array($type, ['book', 'food', 'medicals']);
    }

    public function monetaryValuealueInPercentage($percent)
    {
        $money = Money::fromCent(
            $this->attributes['price'] * 100
        );

        return $money->partsPercent($percent);
    }

    public function finalValue()
    {
        return $this->getPropery('price')
            + $this->importDuty()
            + $this->salesTaxes()
        ;
    }

    public function importDuty()
    {
        return $this->getPropery('imported')
            ? $this->monetaryValuealueInPercentage(5)
            : 0
        ;
    }

    public function salesTaxes()
    {
        return $this->isTaxable()
            ? $this->monetaryValuealueInPercentage(10)
            : 0
        ;
    }
}
