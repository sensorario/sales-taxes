<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;
use Sensorario\Rounding\Good;

final class GoodTest extends PHPUnit_Framework_TestCase
{
    public function testImportedNotTaxed()
    {
        $good = Good::box([
            'type'     => 'food',
            'price'    => 11.25,
            'imported' => true,
        ]);

        $this->assertEquals(11.25, $good->price());
        $this->assertEquals(0.6, $good->valuePercent(5));
        $this->assertSame(true, $good->isImported());
        $this->assertEquals(11.85, $good->finalValue());
        $this->assertSame(false, $good->isTaxed());
    }

    public function testImportedTaxed()
    {
        $good = Good::box([
            'type'     => 'perfume',
            'price'    => 27.99,
            'imported' => true,
        ]);

        $this->assertSame(true, $good->isTaxed());
        $this->assertEquals(32.19, $good->finalValue());
    }
}
