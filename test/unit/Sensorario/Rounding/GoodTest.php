<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;
use Sensorario\Rounding\Good;

final class GoodTest extends PHPUnit_Framework_TestCase
{
    public function testImportedNotTaxed()
    {
        $good = Good::box([
            'price'    => 11.25,
            'imported' => true,
        ]);

        $this->assertEquals(6, $good->valuePercent(5));
        $this->assertSame(true, $good->isImported());
    }
}
