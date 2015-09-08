<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;
use Sensorario\Rounding\Good;

final class GoodTest extends PHPUnit_Framework_TestCase
{
    public function testAGoodIsNotTaxesExemptByDefault()
    {
        $good = Good::withAttributes([
            'type'     => 'fake type',
        ]);

        $this->assertSame(false, $good->isTaxesExempt());
    }

    /**
     * @dataProvider goodsTaxesExempt
     */
    public function testGoodsTaxesExepmt($type)
    {
        $good = Good::withAttributes([
            'type' => $type,
        ]);

        $this->assertSame(true, $good->isTaxesExempt());
    }

    public function goodsTaxesExempt()
    {
        return [
            ['book'],
            ['food'],
            ['medicals'],
        ];
    }

    public function testImportDutyWhenIsImportedAndTaxesExempt()
    {
        $good = Good::withAttributes([
            'type'     => 'food',
            'price'    => 11.25,
            'imported' => true,
        ]);

        $this->assertEquals(0.6, $good->importDuty());
    }

    public function tesFinalValueWhenIsImportedAndTaxesExempt()
    {
        $good = Good::withAttributes([
            'type'     => 'food',
            'price'    => 11.25,
            'imported' => true,
        ]);

        $this->assertEquals(11.85, $good->finalValue());
    }

    public function testSalesTaxesWhenImportedAndNotExemptFromTaxes()
    {
        $good = Good::withAttributes([
            'type'     => 'perfume',
            'price'    => 27.99,
            'imported' => true,
        ]);

        $this->assertEquals(2.8, $good->basicSalesTax());
    }

    public function testFinalValueWhenNotImportedAndNotExemptFromTaxes()
    {
        $good = Good::withAttributes([
            'type'     => 'music cd',
            'price'    => 18.99,
            'imported' => false,
        ]);

        $this->assertEquals(20.89, $good->finalValue());
    }

    public function testFinalValueWhenNotImportedAndExemptFromTaxes()
    {
        $good = Good::withAttributes([
            'type'     => 'medicals',
            'price'    => 9.75,
            'imported' => false,
        ]);

        $this->assertEquals(9.75, $good->finalValue());
    }
}
