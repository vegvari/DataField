<?php

use Data\Type\IntType;
use Data\Field\IntField;

/**
 * @coversDefaultClass \Data\Field\IntField
 */
class IntFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function signedNotNull()
    {
        $instance = new IntField('test', new IntType(), false, false, false);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof IntType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(IntField::MIN_FIELD_VALUE_SIGNED, $instance->getMinValue());
        $this->assertSame(IntField::MAX_FIELD_VALUE_SIGNED, $instance->getMaxValue());

        $instance = IntField::signedNotNull('test', 12);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof IntType);
        $this->assertSame(12, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(~IntField::MAX_FIELD_VALUE_SIGNED, $instance->getMinValue());
        $this->assertSame(IntField::MAX_FIELD_VALUE_SIGNED, $instance->getMaxValue());
    }

    /**
     * @test
     */
    public function signedNullable()
    {
        $instance = new IntField('test', new IntType(), true, false, false);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof IntType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(IntField::MIN_FIELD_VALUE_SIGNED, $instance->getMinValue());
        $this->assertSame(IntField::MAX_FIELD_VALUE_SIGNED, $instance->getMaxValue());

        $instance = IntField::signedNullable('test', 12);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof IntType);
        $this->assertSame(12, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(IntField::MIN_FIELD_VALUE_SIGNED, $instance->getMinValue());
        $this->assertSame(IntField::MAX_FIELD_VALUE_SIGNED, $instance->getMaxValue());
    }

    /**
     * @test
     */
    public function unsignedNotNull()
    {
        $instance = new IntField('test', new IntType(), false, true, false);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof IntType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(IntField::MIN_FIELD_VALUE_UNSIGNED, $instance->getMinValue());
        $this->assertSame(IntField::MAX_FIELD_VALUE_UNSIGNED, $instance->getMaxValue());

        $instance = IntField::unsignedNotNull('test', 12);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof IntType);
        $this->assertSame(12, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(IntField::MIN_FIELD_VALUE_UNSIGNED, $instance->getMinValue());
        $this->assertSame(IntField::MAX_FIELD_VALUE_UNSIGNED, $instance->getMaxValue());
    }

    /**
     * @test
     */
    public function unsignedNullable()
    {
        $instance = new IntField('test', new IntType(), true, true, false);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof IntType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(IntField::MIN_FIELD_VALUE_UNSIGNED, $instance->getMinValue());
        $this->assertSame(IntField::MAX_FIELD_VALUE_UNSIGNED, $instance->getMaxValue());

        $instance = IntField::unsignedNullable('test', 12);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof IntType);
        $this->assertSame(12, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(false, $instance->isSerial());
        $this->assertSame(IntField::MIN_FIELD_VALUE_UNSIGNED, $instance->getMinValue());
        $this->assertSame(IntField::MAX_FIELD_VALUE_UNSIGNED, $instance->getMaxValue());
    }

    /**
     * @test
     */
    public function serial()
    {
        $instance = new IntField('test', new IntType(), false, true, true);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof IntType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(true, $instance->isSerial());
        $this->assertSame(IntField::MIN_FIELD_VALUE_SERIAL, $instance->getMinValue());
        $this->assertSame(IntField::MAX_FIELD_VALUE_SERIAL, $instance->getMaxValue());

        $instance = IntField::serial('test', 12);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof IntType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(true, $instance->isSerial());
        $this->assertSame(IntField::MIN_FIELD_VALUE_SERIAL, $instance->getMinValue());
        $this->assertSame(IntField::MAX_FIELD_VALUE_SERIAL, $instance->getMaxValue());
    }

    /**
     * @test
     * @dataProvider constructFailProvider
     */
    public function constructFail(Closure $closure, $expected, $message)
    {
        $this->setExpectedException($expected, $message);
        $closure();
    }

    public function constructFailProvider()
    {
        return [
            [function () { return new IntField('test', new IntType(), 1, false, false); }, 'InvalidArgumentException', 'Nullable must be bool'],
            [function () { return new IntField('test', new IntType(), false, 1, false); }, 'InvalidArgumentException', 'Unsigned must be bool'],
            [function () { return new IntField('test', new IntType(), false, false, 1); }, 'InvalidArgumentException', 'Serial must be bool'],
            [function () { return new IntField('test', new IntType(), false, false, true); }, 'InvalidArgumentException', 'Serial field must be unsigned'],
            [function () { return new IntField('test', new IntType(), true, true, true); }, 'InvalidArgumentException', 'Serial field can\'t be nullable'],
            [function () { return new IntField('test', new IntType(), true, false, true); }, 'InvalidArgumentException', 'Serial field can\'t be nullable'],
            [function () { return new IntField('test', new IntType(1), false, true, true); }, 'InvalidArgumentException', 'Serial field\'s default value must be null: "1"'],
        ];
    }

    /**
     * @test
     * @dataProvider checkFailProvider
     */
    public function checkFail(Closure $closure, $expected)
    {
        $this->setExpectedException($expected);
        $closure();
    }

    public function checkFailProvider()
    {
        return [
            [function () { return IntField::signedNullable('test', ~IntField::MAX_FIELD_VALUE_SIGNED - 1); }, 'Data\Field\Exceptions\MinValueException'],
            [function () { return IntField::signedNotNull('test', ~IntField::MAX_FIELD_VALUE_SIGNED - 1); }, 'Data\Field\Exceptions\MinValueException'],
            [function () { $field = IntField::signedNullable('test'); $field->getData()->set(~IntField::MAX_FIELD_VALUE_SIGNED - 1); return $field; }, 'Data\Field\Exceptions\MinValueException'],
            [function () { $field = IntField::signedNotNull('test'); $field->getData()->set(~IntField::MAX_FIELD_VALUE_SIGNED - 1); return $field; }, 'Data\Field\Exceptions\MinValueException'],
            [function () { return IntField::signedNullable('test', IntField::MAX_FIELD_VALUE_SIGNED + 1); }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { return IntField::signedNotNull('test', IntField::MAX_FIELD_VALUE_SIGNED + 1); }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { $field = IntField::signedNullable('test'); $field->getData()->set(IntField::MAX_FIELD_VALUE_SIGNED + 1); return $field; }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { $field = IntField::signedNotNull('test'); $field->getData()->set(IntField::MAX_FIELD_VALUE_SIGNED + 1); return $field; }, 'Data\Field\Exceptions\MaxValueException'],

            [function () { return IntField::unsignedNullable('test', IntField::MIN_FIELD_VALUE_UNSIGNED - 1); }, 'Data\Field\Exceptions\MinValueException'],
            [function () { return IntField::unsignedNotNull('test', IntField::MIN_FIELD_VALUE_UNSIGNED - 1); }, 'Data\Field\Exceptions\MinValueException'],
            [function () { $field = IntField::unsignedNullable('test'); $field->getData()->set(IntField::MIN_FIELD_VALUE_UNSIGNED - 1); return $field; }, 'Data\Field\Exceptions\MinValueException'],
            [function () { $field = IntField::unsignedNotNull('test'); $field->getData()->set(IntField::MIN_FIELD_VALUE_UNSIGNED - 1); return $field; }, 'Data\Field\Exceptions\MinValueException'],
            [function () { return IntField::unsignedNullable('test', IntField::MAX_FIELD_VALUE_UNSIGNED + 1); }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { return IntField::unsignedNotNull('test', IntField::MAX_FIELD_VALUE_UNSIGNED + 1); }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { $field = IntField::unsignedNullable('test'); $field->getData()->set(IntField::MAX_FIELD_VALUE_UNSIGNED + 1); return $field; }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { $field = IntField::unsignedNotNull('test'); $field->getData()->set(IntField::MAX_FIELD_VALUE_UNSIGNED + 1); return $field; }, 'Data\Field\Exceptions\MaxValueException'],

            [function () { $field = IntField::serial('test'); $field->getData()->set(IntField::MIN_FIELD_VALUE_SERIAL - 1); return $field; }, 'Data\Field\Exceptions\MinValueException'],
            [function () { $field = IntField::serial('test'); $field->getData()->set(IntField::MAX_FIELD_VALUE_SERIAL + 1); return $field; }, 'Data\Field\Exceptions\MaxValueException'],
        ];
    }
}
