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

    public function isTaxesExempt()
    {
        $type = $this->getPropery('type');

        return in_array($type, ['book', 'food', 'medicals']);
    }

    public function monetaryValueInPercentage($percent)
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
            + $this->basicSalesTax()
        ;
    }

    public function importDuty()
    {
        return $this->getPropery('imported')
            ? $this->monetaryValueInPercentage(5)
            : 0
        ;
    }

    public function basicSalesTax()
    {
        return $this->isTaxesExempt()
            ? 0
            : $this->monetaryValueInPercentage(10)
        ;
    }
}
