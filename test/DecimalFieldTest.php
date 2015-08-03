<?php

use Data\Type\FloatType;
use Data\Field\DecimalField;

/**
 * @coversDefaultClass \Data\Field\DecimalField
 */
class DecimalFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function signedNotNull()
    {
        $instance = new DecimalField('test', new FloatType(), false, false, 10, 2);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());

        $instance = DecimalField::signedNotNull('test', 10, 2, 0);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(0.0, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
    }

    /**
     * @test
     */
    public function signedNullable()
    {
        $instance = new DecimalField('test', new FloatType(), true, false, 10, 2);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());

        $instance = DecimalField::signedNullable('test', 10, 2, 0);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(0.0, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
    }

    /**
     * @test
     */
    public function unsignedNotNull()
    {
        $instance = new DecimalField('test', new FloatType(), false, true, 10, 2);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());

        $instance = DecimalField::unsignedNotNull('test', 10, 2, 0);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(0.0, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
    }

    /**
     * @test
     */
    public function unsignedNullable()
    {
        $instance = new DecimalField('test', new FloatType(), true, true, 10, 2);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());

        $instance = DecimalField::unsignedNullable('test', 10, 2, 0);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(0.0, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
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
            [function () { return new DecimalField('test', new FloatType(), false, false, null, 2); }, 'InvalidArgumentException', 'Precision must int be between 1-65: ""'],
            [function () { return new DecimalField('test', new FloatType(), false, false, '', 2); }, 'InvalidArgumentException', 'Precision must int be between 1-65: ""'],
            [function () { return new DecimalField('test', new FloatType(), false, false, 0, 2); }, 'InvalidArgumentException', 'Precision must int be between 1-65: "0"'],
            [function () { return new DecimalField('test', new FloatType(), false, false, 66, 2); }, 'InvalidArgumentException', 'Precision must int be between 1-65: "66"'],
            [function () { return new DecimalField('test', new FloatType(), false, false, 10, null); }, 'InvalidArgumentException', 'Scale must be int between 0-30: ""'],
            [function () { return new DecimalField('test', new FloatType(), false, false, 10, ''); }, 'InvalidArgumentException', 'Scale must be int between 0-30: ""'],
            [function () { return new DecimalField('test', new FloatType(), false, false, 10, 31); }, 'InvalidArgumentException', 'Scale must be int between 0-30: "31"'],
            [function () { return new DecimalField('test', new FloatType(), false, false, 10, 30); }, 'InvalidArgumentException', 'Scale is greater than precision: "30 > 10"'],
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
            [function () { return DecimalField::signedNotNull('test', 10, 2, -100000000); }, 'Data\Field\Exceptions\MinValueException'],
            [function () { return DecimalField::signedNotNull('test', 10, 2, 100000000); }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { return DecimalField::signedNullable('test', 10, 2, -100000000); }, 'Data\Field\Exceptions\MinValueException'],
            [function () { return DecimalField::signedNullable('test', 10, 2, 100000000); }, 'Data\Field\Exceptions\MaxValueException'],

            [function () { return DecimalField::unsignedNotNull('test', 10, 2, -1); }, 'Data\Field\Exceptions\MinValueException'],
            [function () { return DecimalField::unsignedNotNull('test', 10, 2, 100000000); }, 'Data\Field\Exceptions\MaxValueException'],
            [function () { return DecimalField::unsignedNullable('test', 10, 2, -1); }, 'Data\Field\Exceptions\MinValueException'],
            [function () { return DecimalField::unsignedNullable('test', 10, 2, 100000000); }, 'Data\Field\Exceptions\MaxValueException'],
        ];
    }
}
