<?php

use Data\Type\IntType;
use Data\Field\IntField;

/**
 * @coversDefaultClass \Data\Field\IntField
 */
class IntFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var int
     */
    protected $signed_max = 2147483647;

    /**
     * @var int
     */
    protected $unsigned_max = 4294967295;

    /**
     * @var int
     */
    protected $serial_max = 4294967295;

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
     * @covers ::getMinValue
     * @covers ::getMaxValue
     * @covers ::isChanged
     * @covers ::isSerial
     */
    public function construct()
    {
        $data = new IntType();

        $instance = new IntField('test', $data, false, false, false);
        $this->assertSame(false, $instance->isChanged());
        $this->assertSame('test', $instance->getName());
        $this->assertSame($data, $instance->getData());
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(~$this->signed_max, $instance->getMinValue());
        $this->assertSame($this->signed_max, $instance->getMaxValue());

        $instance = new IntField('test', $data, true, true, false);
        $this->assertSame(false, $instance->isChanged());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(0, $instance->getMinValue());
        $this->assertSame($this->unsigned_max, $instance->getMaxValue());

        $instance = new IntField('test', $data, true, false, false);
        $this->assertSame(false, $instance->isChanged());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(~$this->signed_max, $instance->getMinValue());
        $this->assertSame($this->signed_max, $instance->getMaxValue());

        $instance = new IntField('test', $data, false, true, false);
        $this->assertSame(false, $instance->isChanged());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(0, $instance->getMinValue());
        $this->assertSame($this->unsigned_max, $instance->getMaxValue());

        $instance = new IntField('test', $data, false, true, true);
        $this->assertSame(false, $instance->isChanged());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(true, $instance->isSerial());
        $this->assertSame(1, $instance->getMinValue());
        $this->assertSame($this->serial_max, $instance->getMaxValue());
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
     * @covers ::getMinValue
     * @covers ::getMaxValue
     * @covers ::isSerial
     * @covers ::signedNotNull
     */
    public function signedNotNull()
    {
        $instance = IntField::signedNotNull('test');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->getData()->isNull());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(~$this->signed_max, $instance->getMinValue());
        $this->assertSame($this->signed_max, $instance->getMaxValue());

        $instance = IntField::signedNotNull('test', 1);
        $this->assertSame(1, $instance->getData()->value());
        $this->assertSame(1, $instance->getDefault());

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
     * @covers ::getMinValue
     * @covers ::getMaxValue
     * @covers ::isSerial
     * @covers ::signedNullable
     */
    public function signedNullable()
    {
        $instance = IntField::signedNullable('test');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData()->isNull());
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(~$this->signed_max, $instance->getMinValue());
        $this->assertSame($this->signed_max, $instance->getMaxValue());

        $instance = IntField::signedNullable('test', 1);
        $this->assertSame(1, $instance->getData()->value());
        $this->assertSame(1, $instance->getDefault());
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
     * @covers ::getMinValue
     * @covers ::getMaxValue
     * @covers ::isSerial
     * @covers ::unsignedNotNull
     */
    public function unsignedNotNull()
    {
        $instance = IntField::unsignedNotNull('test');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData()->isNull());
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(0, $instance->getMinValue());
        $this->assertSame($this->unsigned_max, $instance->getMaxValue());

        $instance = IntField::unsignedNotNull('test', 1);
        $this->assertSame(1, $instance->getData()->value());
        $this->assertSame(1, $instance->getDefault());
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
     * @covers ::getMinValue
     * @covers ::getMaxValue
     * @covers ::isSerial
     * @covers ::unsignedNullable
     */
    public function unsignedNullable()
    {
        $instance = IntField::unsignedNullable('test');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData()->isNull());
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(0, $instance->getMinValue());
        $this->assertSame($this->unsigned_max, $instance->getMaxValue());

        $instance = IntField::unsignedNullable('test', 1);
        $this->assertSame(1, $instance->getData()->value());
        $this->assertSame(1, $instance->getDefault());
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
     * @covers ::getMinValue
     * @covers ::getMaxValue
     * @covers ::isSerial
     * @covers ::serial
     */
    public function serial()
    {
        $instance = IntField::serial('test');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData()->isNull());
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(true, $instance->isSerial());
        $this->assertSame(1, $instance->getMinValue());
        $this->assertSame($this->serial_max, $instance->getMaxValue());

        $instance = IntField::serial('test', 1);
        $this->assertSame(null, $instance->getData()->value());
        $this->assertSame(null, $instance->getDefault());
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
     * @covers       ::serial
     */
    public function constructFail(Closure $closure, $expected)
    {
        $this->setExpectedException($expected);
        $closure();
    }

    public function constructFailProvider()
    {
        return [
            [function () { return new IntField(1, new IntType(), false, false, false); }, 'InvalidArgumentException'],
            [function () { return new IntField('test', new IntType(), 1, false, false); }, 'InvalidArgumentException'],
            [function () { return new IntField('test', new IntType(), false, 1, false); }, 'InvalidArgumentException'],
            [function () { return new IntField('test', new IntType(), false, false, 1); }, 'InvalidArgumentException'],
            [function () { return new IntField('test', new IntType(), false, false, true); }, 'InvalidArgumentException'],
            [function () { return new IntField('test', new IntType(), true, true, true); }, 'InvalidArgumentException'],
            [function () { return new IntField('test', new IntType(), true, false, true); }, 'InvalidArgumentException'],
            [function () { return new IntField('test', new IntType(1), false, true, true); }, 'InvalidArgumentException'],
            [function () { return IntField::signedNotNull(1); }, 'InvalidArgumentException'],
            [function () { return IntField::signedNullable(1); }, 'InvalidArgumentException'],
            [function () { return IntField::unsignedNotNull(1); }, 'InvalidArgumentException'],
            [function () { return IntField::unsignedNullable(1); }, 'InvalidArgumentException'],
            [function () { return IntField::serial(1); }, 'InvalidArgumentException'],
        ];
    }

    /**
     * @test
     * @dataProvider checkFailProvider
     * @covers       \Data\Field\Field::__construct
     * @covers       \Data\Field\Field::getName
     * @covers       \Data\Field\Field::getData
     * @covers       \Data\Field\Field::update
     * @covers       \Data\Field\NumberField::__construct
     * @covers       \Data\Field\NumberField::check
     * @covers       \Data\Field\NumberField::isUnsigned
     * @covers       ::__construct
     * @covers       ::check
     * @covers       ::getMinValue
     * @covers       ::getMaxValue
     * @covers       ::isSerial
     * @covers       ::signedNotNull
     * @covers       ::signedNullable
     * @covers       ::unsignedNotNull
     * @covers       ::unsignedNullable
     * @covers       ::serial
     */
    public function checkFail(Closure $closure, $expected)
    {
        $this->setExpectedException($expected);
        $closure();
    }

    public function checkFailProvider()
    {
        return [
            [function () { return IntField::signedNullable('test', ~$this->signed_max - 1); }, 'Data\Field\Exceptions\MinValueException'],
            [function () { return IntField::signedNotNull('test', ~$this->signed_max - 1); }, 'Data\Field\Exceptions\MinValueException'],
            [function () { $field = IntField::signedNullable('test'); $field->getData()->set(~$this->signed_max - 1); return $field; }, 'Data\Field\Exceptions\MinValueException'],
            [function () { $field = IntField::signedNotNull('test'); $field->getData()->set(~$this->signed_max - 1); return $field; }, 'Data\Field\Exceptions\MinValueException'],
            [function () { return IntField::signedNullable('test', $this->signed_max + 1); }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { return IntField::signedNotNull('test', $this->signed_max + 1); }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { $field = IntField::signedNullable('test'); $field->getData()->set($this->signed_max + 1); return $field; }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { $field = IntField::signedNotNull('test'); $field->getData()->set($this->signed_max + 1); return $field; }, 'Data\Field\Exceptions\MaxValueException'],

            [function () { return IntField::unsignedNullable('test', 0 - 1); }, 'Data\Field\Exceptions\MinValueException'],
            [function () { return IntField::unsignedNotNull('test', 0 - 1); }, 'Data\Field\Exceptions\MinValueException'],
            [function () { $field = IntField::unsignedNullable('test'); $field->getData()->set(-1); return $field; }, 'Data\Field\Exceptions\MinValueException'],
            [function () { $field = IntField::unsignedNotNull('test'); $field->getData()->set(-1); return $field; }, 'Data\Field\Exceptions\MinValueException'],
            [function () { return IntField::unsignedNullable('test', $this->unsigned_max + 1); }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { return IntField::unsignedNotNull('test', $this->unsigned_max + 1); }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { $field = IntField::unsignedNullable('test'); $field->getData()->set($this->unsigned_max + 1); return $field; }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { $field = IntField::unsignedNotNull('test'); $field->getData()->set($this->unsigned_max + 1); return $field; }, 'Data\Field\Exceptions\MaxValueException'],

            [function () { $field = IntField::serial('test'); $field->getData()->set(0); return $field; }, 'Data\Field\Exceptions\MinValueException'],
            [function () { $field = IntField::serial('test'); $field->getData()->set($this->serial_max + 1); return $field; }, 'Data\Field\Exceptions\MaxValueException'],
        ];
    }
}
