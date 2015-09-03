<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;

final class GoodCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testIsEmpty()
    {
        $collection = new GoodCollection();

        $this->assertSame(
            true,
            $collection->isEmpty()
        );

        $this->assertEquals(
            [],
            $collection->items()
        );
    }
}
