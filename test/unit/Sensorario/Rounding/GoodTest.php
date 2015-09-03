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
        $this->assertEquals(0.6, $good->importDuty());
        $this->assertEquals(1.2, $good->salesTaxes());
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

    public function testNotImportedTaxed()
    {
        $good = Good::box([
            'type'     => 'music cd',
            'price'    => 18.99,
            'imported' => false,
        ]);

        $this->assertSame(true, $good->isTaxed());
        $this->assertEquals(20.89, $good->finalValue());
    }

    public function testNotImportedNotTaxed()
    {
        $good = Good::box([
            'type'     => 'medicals',
            'price'    => 9.75,
            'imported' => false,
        ]);

        $this->assertSame(false, $good->isTaxed());
        $this->assertEquals(9.75, $good->finalValue());
    }

    public function testNonTaxedTypes()
    {
        $this->assertEquals(
            ['food', 'medicals'],
            Good::nonTaxedTypes()
        );
    }
}
