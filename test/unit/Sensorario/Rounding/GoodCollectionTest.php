<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;

final class GoodCollectionTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->collection = new GoodCollection();
    }

    public function testIsEmpty()
    {
        $this->assertSame(
            true,
            $this->collection->isEmpty()
        );

        $this->assertEquals(
            0,
            $this->collection->itemCount()
        );
    }

    public function testAcceptNewGoodItems()
    {
        $good = Good::box([
            'type'     => 'music cd',
            'price'    => 18.99,
            'imported' => false,
        ]);

        $this->collection->addItem($good);

        $this->assertEquals(
            1,
            $this->collection->itemCount()
        );
    }

    public function testknowIfAGoodIsInsideTheCollection()
    {
        $cd = Good::box([
            'type'     => 'music cd',
            'price'    => 18.99,
            'imported' => false,
        ]);

        $pills = Good::box([
            'type'     => 'pills',
        ]);

        $this->collection->addItem($cd);

        $this->assertTrue($this->collection->has($cd));
        $this->assertFalse($this->collection->has($pills));
    }
}
