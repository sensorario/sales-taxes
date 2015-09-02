<?php

namespace Sensorario;

final class Good
{
    private $properties;

    private function __construct(array $properties)
    {
        $this->properties = $properties;

        $price = $this->properties['price'];

        $this->tax = Good::roundUpToTheNeares0_05($price);

        $this->fullPrice = (
            $price * 100 + $this->tax * 10
        ) / 100;
    }

    public static function roundUpToTheNeares0_05($price)
    {
        return ceil($price/10*5);
    }

    public static function priceToRound($price)
    {
        return $price/10*5;
    }

    public static function create(array $properties)
    {
        return new self($properties);
    }

    public function taxedPrice()
    {
        return $this->fullPrice;
    }

    public function isImported()
    {
        return $this->getProperty('imported');
    }

    public function price()
    {
        return $this->getProperty('price');
    }

    private function getProperty($propertyName)
    {
        return $this->properties[$propertyName];
    }

    public function salesTax()
    {
        return $this->tax;
    }
}
