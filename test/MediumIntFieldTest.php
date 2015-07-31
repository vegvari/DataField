<?php

use Data\Field\MediumIntField;

/**
 * @coversDefaultClass \Data\Field\MediumIntField
 */
class MediumIntFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var int
     */
    protected $signed_max = 8388607;

    /**
     * @var int
     */
    protected $unsigned_max = 16777215;

    /**
     * @var int
     */
    protected $serial_max = 16777215;

    /**
     * @test
     * @covers \Data\Field\Field::__construct
     * @covers \Data\Field\Field::getName
     * @covers \Data\Field\Field::getData
     * @covers \Data\Field\Field::getDefault
     * @covers \Data\Field\Field::isNullable
     * @covers \Data\Field\NumberField::__construct
     * @covers \Data\Field\NumberField::isUnsigned
     * @covers \Data\Field\IntField::__construct
     * @covers \Data\Field\IntField::getMinValue
     * @covers \Data\Field\IntField::getMaxValue
     * @covers \Data\Field\IntField::isSerial
     * @covers \Data\Field\IntField::signedNotNull
     * @covers \Data\Field\IntField::signedNullable
     * @covers \Data\Field\IntField::unsignedNotNull
     * @covers \Data\Field\IntField::unsignedNullable
     * @covers \Data\Field\IntField::serial
     */
    public function construct()
    {
        $instance = MediumIntField::signedNotNull('test');
        $this->assertSame(~$this->signed_max, $instance->getMinValue());
        $this->assertSame($this->signed_max, $instance->getMaxValue());

        $instance = MediumIntField::signedNullable('test');
        $this->assertSame(~$this->signed_max, $instance->getMinValue());
        $this->assertSame($this->signed_max, $instance->getMaxValue());

        $instance = MediumIntField::unsignedNotNull('test');
        $this->assertSame(0, $instance->getMinValue());
        $this->assertSame($this->unsigned_max, $instance->getMaxValue());

        $instance = MediumIntField::unsignedNullable('test');
        $this->assertSame(0, $instance->getMinValue());
        $this->assertSame($this->unsigned_max, $instance->getMaxValue());

        $instance = MediumIntField::serial('test');
        $this->assertSame(1, $instance->getMinValue());
        $this->assertSame($this->serial_max, $instance->getMaxValue());
    }
}
