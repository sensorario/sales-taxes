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
            $this->collection->count()
        );
    }

    public function testAcceptNewGoodItems()
    {
        $good = Good::withAttributes([
            'type'     => 'music cd',
            'price'    => 18.99,
            'imported' => false,
        ]);

        $this->collection->addItem($good);

        $this->assertEquals(
            1,
            $this->collection->count()
        );
    }

    public function testknowIfAGoodIsInsideTheCollection()
    {
        $cd = Good::withAttributes([
            'type'     => 'music cd',
            'price'    => 18.99,
            'imported' => false,
        ]);

        $pills = Good::withAttributes([
            'type'     => 'pills',
        ]);

        $this->collection->addItem($cd);

        $this->assertTrue($this->collection->has($cd));
        $this->assertFalse($this->collection->has($pills));
    }

    public function testKnowsTotalTaxesOfGood()
    {
        $this->collection->addItem(Good::withAttributes([
            'type'     => 'book',
            'price'    => 12.49,
            'imported' => false,
        ]));

        $this->collection->addItem(Good::withAttributes([
            'type'     => 'music cd',
            'price'    => 14.99,
            'imported' => false,
        ]));

        $this->collection->addItem(Good::withAttributes([
            'type'     => 'food',
            'price'    => 0.85,
            'imported' => false,
        ]));

        $this->assertEquals(
            1.50,
            $this->collection->salesTaxes()
        );

        $this->assertEquals(
            29.83,
            $this->collection->totalAmount()
        );
    }

    public function testKnowsTotalTaxesOfGoodThree()
    {
        $this->collection->addItem(Good::withAttributes([
            'type'     => 'perfume',
            'price'    => 27.99,
            'imported' => true,
        ]));

        $this->collection->addItem(Good::withAttributes([
            'type'     => 'perfume',
            'price'    => 18.99,
            'imported' => false,
        ]));

        $this->collection->addItem(Good::withAttributes([
            'type'     => 'medicals',
            'price'    => 9.75,
            'imported' => false,
        ]));

        $this->collection->addItem(Good::withAttributes([
            'type'     => 'food',
            'price'    => 11.25,
            'imported' => true,
        ]));

        $this->assertEquals(
            6.70,
            $this->collection->salesTaxes()
        );

        $this->assertEquals(
            74.68,
            $this->collection->totalAmount()
        );
    }

    public function testKnowsTotalTaxesOfGoodTwo()
    {
        $this->collection->addItem(Good::withAttributes([
            'type'     => 'food',
            'price'    => 10.00,
            'imported' => true,
        ]));

        $this->collection->addItem(Good::withAttributes([
            'type'     => 'perfume',
            'price'    => 47.50,
            'imported' => true,
        ]));

        $this->assertEquals(
            7.65,
            $this->collection->salesTaxes()
        );

        $this->assertEquals(
            65.15,
            $this->collection->totalAmount()
        );
    }
}
