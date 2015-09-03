<?php

namespace Sensorario\Rounding;

use Sensorario\Rounding\Good;

class GoodCollection
{
    private $goods = [];

    public function isEmpty()
    {
        return true;
    }

    public function itemCount()
    {
        return count($this->goods);
    }

    public function addItem(Good $good)
    {
        $this->goods[] = $good;
    }

    public function has(Good $good)
    {
        return in_array(
            $good,
            $this->goods
        );
    }

    public function salesTaxes()
    {
        $salesTaxes = 0;

        foreach ($this->goods as $good) {
            if ($good->isTaxed()) {
                $salesTaxes += $good->salesTaxes();
            }
        }

        return $salesTaxes;
    }
}
