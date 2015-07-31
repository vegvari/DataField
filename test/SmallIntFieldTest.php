<?php

use Data\Field\SmallIntField;

/**
 * @coversDefaultClass \Data\Field\SmallIntField
 */
class SmallIntFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var int
     */
    protected $signed_max = 32767;

    /**
     * @var int
     */
    protected $unsigned_max = 65535;

    /**
     * @var int
     */
    protected $serial_max = 65535;

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
        $instance = SmallIntField::signedNotNull('test');
        $this->assertSame(~$this->signed_max, $instance->getMinValue());
        $this->assertSame($this->signed_max, $instance->getMaxValue());

        $instance = SmallIntField::signedNullable('test');
        $this->assertSame(~$this->signed_max, $instance->getMinValue());
        $this->assertSame($this->signed_max, $instance->getMaxValue());

        $instance = SmallIntField::unsignedNotNull('test');
        $this->assertSame(0, $instance->getMinValue());
        $this->assertSame($this->unsigned_max, $instance->getMaxValue());

        $instance = SmallIntField::unsignedNullable('test');
        $this->assertSame(0, $instance->getMinValue());
        $this->assertSame($this->unsigned_max, $instance->getMaxValue());

        $instance = SmallIntField::serial('test');
        $this->assertSame(1, $instance->getMinValue());
        $this->assertSame($this->serial_max, $instance->getMaxValue());
    }
}
