<?php

namespace Sensorario\Rounding;

use PHPUnit_Framework_TestCase;

final class BasketTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->basket = new Basket();
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

        $this->basket->add($cd);

        $this->assertTrue($this->basket->has($cd));
        $this->assertFalse($this->basket->has($pills));
    }

    public function testKnowsTotalTaxesOfGood()
    {
        $this->basket->add(Good::withAttributes([
            'type'     => 'book',
            'price'    => 12.49,
            'imported' => false,
        ]));

        $this->basket->add(Good::withAttributes([
            'type'     => 'music cd',
            'price'    => 14.99,
            'imported' => false,
        ]));

        $this->basket->add(Good::withAttributes([
            'type'     => 'food',
            'price'    => 0.85,
            'imported' => false,
        ]));

        $this->assertEquals(
            1.50,
            $this->basket->salesTaxes()
        );

        $this->assertEquals(
            29.83,
            $this->basket->totalAmount()
        );
    }

    public function testKnowsTotalTaxesOfGoodTwo()
    {
        $this->basket->add(Good::withAttributes([
            'type'     => 'food',
            'price'    => 10.00,
            'imported' => true,
        ]));

        $this->basket->add(Good::withAttributes([
            'type'     => 'perfume',
            'price'    => 47.50,
            'imported' => true,
        ]));

        $this->assertEquals(
            7.65,
            $this->basket->salesTaxes()
        );

        $this->assertEquals(
            65.15,
            $this->basket->totalAmount()
        );
    }

    public function testKnowsTotalTaxesOfGoodThree()
    {
        $this->basket->add(Good::withAttributes([
            'type'     => 'perfume',
            'price'    => 27.99,
            'imported' => true,
        ]));

        $this->basket->add(Good::withAttributes([
            'type'     => 'perfume',
            'price'    => 18.99,
            'imported' => false,
        ]));

        $this->basket->add(Good::withAttributes([
            'type'     => 'medicals',
            'price'    => 9.75,
            'imported' => false,
        ]));

        $this->basket->add(Good::withAttributes([
            'type'     => 'food',
            'price'    => 11.25,
            'imported' => true,
        ]));

        $this->assertEquals(
            6.70,
            $this->basket->salesTaxes()
        );

        $this->assertEquals(
            74.68,
            $this->basket->totalAmount()
        );
    }
}
