<?php

use Data\Type\FloatType;
use Data\Field\FloatField;

/**
 * @coversDefaultClass \Data\Field\FloatField
 */
class FloatFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers \Data\Field\Field::__construct
     * @covers \Data\Field\Field::getName
     * @covers \Data\Field\Field::getData
     * @covers \Data\Field\Field::getDefault
     * @covers \Data\Field\Field::isNullable
     * @covers \Data\Field\NumberField::__construct
     * @covers \Data\Field\NumberField::isUnsigned
     * @covers ::__construct
     * @covers ::isChanged
     */
    public function construct()
    {
        $data = new FloatType();

        $instance = new FloatField('test', $data, false, false, false);
        $this->assertSame(false, $instance->isChanged());
        $this->assertSame('test', $instance->getName());
        $this->assertSame($data, $instance->getData());
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());

        $instance = new FloatField('test', $data, true, true, false);
        $this->assertSame(false, $instance->isChanged());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());

        $instance = new FloatField('test', $data, true, false, false);
        $this->assertSame(false, $instance->isChanged());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());

        $instance = new FloatField('test', $data, false, true, false);
        $this->assertSame(false, $instance->isChanged());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
    }

    /**
     * @test
     * @covers \Data\Field\Field::__construct
     * @covers \Data\Field\Field::getName
     * @covers \Data\Field\Field::getData
     * @covers \Data\Field\Field::getDefault
     * @covers \Data\Field\Field::update
     * @covers \Data\Field\Field::isChanged
     * @covers \Data\Field\Field::isNullable
     * @covers \Data\Field\NumberField::__construct
     * @covers \Data\Field\NumberField::check
     * @covers \Data\Field\NumberField::isUnsigned
     * @covers ::__construct
     * @covers ::check
     * @covers ::signedNotNull
     */
    public function signedNotNull()
    {
        $instance = FloatField::signedNotNull('test');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->getData()->isNull());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());

        $instance = FloatField::signedNotNull('test', 1);
        $this->assertSame(1.0, $instance->getData()->value());
        $this->assertSame(1.0, $instance->getDefault());

        $instance->getData()->set(null);
        $this->assertSame(true, $instance->isChanged());

        $instance->getData()->set(1);
        $this->assertSame(true, $instance->isChanged());
    }

    /**
     * @test
     * @covers \Data\Field\Field::__construct
     * @covers \Data\Field\Field::getName
     * @covers \Data\Field\Field::getData
     * @covers \Data\Field\Field::getDefault
     * @covers \Data\Field\Field::isNullable
     * @covers \Data\Field\NumberField::__construct
     * @covers \Data\Field\NumberField::check
     * @covers \Data\Field\NumberField::isUnsigned
     * @covers ::__construct
     * @covers ::check
     * @covers ::signedNullable
     */
    public function signedNullable()
    {
        $instance = FloatField::signedNullable('test');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData()->isNull());
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());

        $instance = FloatField::signedNullable('test', 1);
        $this->assertSame(1.0, $instance->getData()->value());
        $this->assertSame(1.0, $instance->getDefault());
    }

    /**
     * @test
     * @covers \Data\Field\Field::__construct
     * @covers \Data\Field\Field::getName
     * @covers \Data\Field\Field::getData
     * @covers \Data\Field\Field::getDefault
     * @covers \Data\Field\Field::isNullable
     * @covers \Data\Field\NumberField::__construct
     * @covers \Data\Field\NumberField::check
     * @covers \Data\Field\NumberField::isUnsigned
     * @covers ::__construct
     * @covers ::check
     * @covers ::unsignedNotNull
     */
    public function unsignedNotNull()
    {
        $instance = FloatField::unsignedNotNull('test');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData()->isNull());
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());

        $instance = FloatField::unsignedNotNull('test', 1);
        $this->assertSame(1.0, $instance->getData()->value());
        $this->assertSame(1.0, $instance->getDefault());
    }

    /**
     * @test
     * @covers \Data\Field\Field::__construct
     * @covers \Data\Field\Field::getName
     * @covers \Data\Field\Field::getData
     * @covers \Data\Field\Field::getDefault
     * @covers \Data\Field\Field::isNullable
     * @covers \Data\Field\NumberField::__construct
     * @covers \Data\Field\NumberField::check
     * @covers \Data\Field\NumberField::isUnsigned
     * @covers ::__construct
     * @covers ::check
     * @covers ::unsignedNullable
     */
    public function unsignedNullable()
    {
        $instance = FloatField::unsignedNullable('test');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData()->isNull());
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());

        $instance = FloatField::unsignedNullable('test', 1);
        $this->assertSame(1.0, $instance->getData()->value());
        $this->assertSame(1.0, $instance->getDefault());
    }

    /**
     * @test
     * @dataProvider constructFailProvider
     * @covers       \Data\Field\Field::__construct
     * @covers       \Data\Field\Field::getName
     * @covers       \Data\Field\Field::getData
     * @covers       \Data\Field\NumberField::__construct
     * @covers       \Data\Field\NumberField::check
     * @covers       \Data\Field\NumberField::isUnsigned
     * @covers       ::__construct
     * @covers       ::check
     * @covers       ::signedNotNull
     * @covers       ::signedNullable
     * @covers       ::unsignedNotNull
     * @covers       ::unsignedNullable
     */
    public function constructFail(Closure $closure, $expected)
    {
        $this->setExpectedException($expected);
        $closure();
    }

    public function constructFailProvider()
    {
        return [
            [function () { return new FloatField(1, new FloatType(), false, false); }, 'InvalidArgumentException'],
            [function () { return new FloatField('test', new FloatType(), 1, false); }, 'InvalidArgumentException'],
            [function () { return new FloatField('test', new FloatType(), false, 1); }, 'InvalidArgumentException'],
            [function () { return FloatField::signedNotNull(1); }, 'InvalidArgumentException'],
            [function () { return FloatField::signedNullable(1); }, 'InvalidArgumentException'],
            [function () { return FloatField::unsignedNotNull(1); }, 'InvalidArgumentException'],
            [function () { return FloatField::unsignedNullable(1); }, 'InvalidArgumentException'],
        ];
    }
}
