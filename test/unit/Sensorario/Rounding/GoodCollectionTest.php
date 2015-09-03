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
            0,
            $collection->itemCount()
        );
    }

    public function testAcceptNewGoodItems()
    {
        $collection = new GoodCollection();

        $good = Good::box([
            'type'     => 'music cd',
            'price'    => 18.99,
            'imported' => false,
        ]);

        $collection->addItem($good);

        $this->assertEquals(
            1,
            $collection->itemCount()
        );
    }
}
