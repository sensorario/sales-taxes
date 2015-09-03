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
}
