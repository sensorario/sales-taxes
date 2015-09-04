<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;
use Sensorario\Rounding\Good;

final class GoodTest extends PHPUnit_Framework_TestCase
{
    public function testImportedNotTaxed()
    {
        $good = Good::withAttributes([
            'type'     => 'food',
            'price'    => 11.25,
            'imported' => true,
        ]);

        $this->assertEquals(0.6, $good->monetaryValueInPercentage(5));
        $this->assertEquals(0.6, $good->importDuty());
        $this->assertSame(false, $good->isTaxable());
        $this->assertSame(true, $good->isntTaxable());
        $this->assertEquals(0, $good->salesTaxes());
        $this->assertEquals(11.85, $good->finalValue());
    }

    public function testImportedTaxed()
    {
        $good = Good::withAttributes([
            'type'     => 'perfume',
            'price'    => 27.99,
            'imported' => true,
        ]);

        $this->assertSame(true, $good->isTaxable());
        $this->assertEquals(32.19, $good->finalValue());
        $this->assertEquals(2.8, $good->salesTaxes());
    }

    public function testNotImportedTaxed()
    {
        $good = Good::withAttributes([
            'type'     => 'music cd',
            'price'    => 18.99,
            'imported' => false,
        ]);

        $this->assertSame(true, $good->isTaxable());
        $this->assertEquals(20.89, $good->finalValue());
    }

    public function testNotImportedNotTaxed()
    {
        $good = Good::withAttributes([
            'type'     => 'medicals',
            'price'    => 9.75,
            'imported' => false,
        ]);

        $this->assertSame(false, $good->isTaxable());
        $this->assertEquals(9.75, $good->finalValue());
    }

    public function testPropertyGetter()
    {
        $good = Good::withAttributes([
            'type'     => 'food',
            'price'    => 11.25,
            'imported' => true,
        ]);

        $this->assertEquals(
            11.25,
            $good->getPropery('price')
        );
    }
}
