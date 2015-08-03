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
     */
    public function signedNotNull()
    {
        $instance = new FloatField('test', new FloatType(), false, false);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());

        $instance = FloatField::signedNotNull('test', 12);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(12.0, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
    }

    /**
     * @test
     */
    public function signedNullable()
    {
        $instance = new FloatField('test', new FloatType(), true, false);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());

        $instance = FloatField::signedNullable('test', 12);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(12.0, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
    }

    /**
     * @test
     */
    public function unsignedNotNull()
    {
        $instance = new FloatField('test', new FloatType(), false, true);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());

        $instance = FloatField::unsignedNotNull('test', 12);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(12.0, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
    }

    /**
     * @test
     */
    public function unsignedNullable()
    {
        $instance = new FloatField('test', new FloatType(), true, true);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());

        $instance = FloatField::unsignedNullable('test', 12);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof FloatType);
        $this->assertSame(12.0, $instance->getDefault());
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
            [function () { return new FloatField('test', new FloatType(), false, 1); }, 'InvalidArgumentException', 'Unsigned must be bool'],
        ];
    }
}
