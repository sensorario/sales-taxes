<?php

namespace Sensorario\SalesTaxes;

use PHPUnit_Framework_TestCase;

final class SalesTaxesTest extends PHPUnit_Framework_TestCase
{
    public function testBasicRate()
    {
        $this->assertEquals(
            0.05,
            SalesTaxes::rate()
        );
    }
}
