<?php

namespace Data\Field;

class DecimalTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $field = Decimal::make(10, 2);
        $this->assertTrue($field->data instanceof \Data\Type\Float);
        $this->assertSame(false, $field->nullable);
        $this->assertSame(false, $field->unsigned);
        $this->assertSame(10, $field->precision);
        $this->assertSame(2, $field->scale);
    }

    public function testDefault()
    {
        $field = Decimal::make(10, 2, 1);
        $this->assertSame(1.0, $field->data->value);
    }

    public function testNullable()
    {
        $field = Decimal::nullable(10, 2);
        $this->assertSame(true, $field->nullable);
        $this->assertSame(false, $field->unsigned);
        $this->assertSame(10, $field->precision);
        $this->assertSame(2, $field->scale);
    }

    public function testUnsigned()
    {
        $field = Decimal::unsigned(10, 2);
        $this->assertSame(false, $field->nullable);
        $this->assertSame(true, $field->unsigned);
        $this->assertSame(10, $field->precision);
        $this->assertSame(2, $field->scale);
    }

    public function testUnsignedInvalidDefault()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Decimal::unsigned(10, 2, -1);
    }

    public function testUnsignedInvalidValue()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Decimal::unsigned(10, 2);
        $field->set(-1);
    }

    public function testUnsignedNullable()
    {
        $field = Decimal::unsignedNullable(10, 2);
        $this->assertSame(true, $field->nullable);
        $this->assertSame(true, $field->unsigned);
        $this->assertSame(10, $field->precision);
        $this->assertSame(2, $field->scale);
    }

    public function testUnsignedNullableInvalidDefault()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Decimal::unsignedNullable(10, 2, -1);
    }

    public function testUnsignedNullableInvalidValue()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Decimal::unsignedNullable(10, 2);
        $field->set(-1);
    }

    public function testPrecision()
    {
        $field = Decimal::make(11, 2);
        $this->assertSame(11, $field->precision);
    }

    public function testPrecisionTooSmall()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Decimal::make(0, 0);
    }

    public function testPrecisionTooLarge()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Decimal::make(66, 0);
    }

    public function testScale()
    {
        $field = Decimal::make(11, 11);
        $this->assertSame(11, $field->scale);
    }

    public function testScaleTooSmall()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Decimal::make(10, -1);
    }

    public function testScaleTooLarge()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Decimal::make(10, 31);
    }

    public function testScaleLargerThanPrecision()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Decimal::make(10, 11);
    }

    public function testMax()
    {
        $field = Decimal::make(10, 0);
        $field->set(9999999999);
    }

    public function testMaxInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Decimal::make(10, 0);
        $field->set(10000000000);
    }

    public function testMin()
    {
        $field = Decimal::make(10, 0);
        $field->set(-9999999999);
    }

    public function testMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Decimal::make(10, 0);
        $field->set(-10000000000);
    }
}
