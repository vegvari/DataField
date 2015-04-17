<?php

namespace Data\Field;

class DecimalTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $field = DecimalField::signed(10, 2);
        $this->assertSame(false, $field->isNullable());
        $this->assertSame(false, $field->isUnsigned());
        $this->assertSame(10, $field->getPrecision());
        $this->assertSame(2, $field->getScale());
    }

    public function testDefault()
    {
        $field = DecimalField::signed(10, 2, 1);
        $this->assertSame(1.0, $field->value());
    }

    public function testNullable()
    {
        $field = DecimalField::nullable(10, 2);
        $this->assertSame(true, $field->isNullable());
        $this->assertSame(false, $field->isUnsigned());
        $this->assertSame(10, $field->getPrecision());
        $this->assertSame(2, $field->getScale());
    }

    public function testUnsigned()
    {
        $field = DecimalField::unsigned(10, 2);
        $this->assertSame(false, $field->isNullable());
        $this->assertSame(true, $field->isUnsigned());
        $this->assertSame(10, $field->getPrecision());
        $this->assertSame(2, $field->getScale());
    }

    public function testUnsignedInvalidDefault()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = DecimalField::unsigned(10, 2, -1);
    }

    public function testUnsignedInvalidValue()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = DecimalField::unsigned(10, 2);
        $field->set(-1);
    }

    public function testUnsignedNullable()
    {
        $field = DecimalField::unsignedNullable(10, 2);
        $this->assertSame(true, $field->isNullable());
        $this->assertSame(true, $field->isUnsigned());
        $this->assertSame(10, $field->getPrecision());
        $this->assertSame(2, $field->getScale());
    }

    public function testUnsignedNullableInvalidDefault()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = DecimalField::unsignedNullable(10, 2, -1);
    }

    public function testUnsignedNullableInvalidValue()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = DecimalField::unsignedNullable(10, 2);
        $field->set(-1);
    }

    public function testPrecision()
    {
        $field = DecimalField::signed(11, 2);
        $this->assertSame(11, $field->getPrecision());
    }

    public function testPrecisionTooSmall()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = DecimalField::signed(0, 0);
    }

    public function testPrecisionTooLarge()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = DecimalField::signed(66, 0);
    }

    public function testScale()
    {
        $field = DecimalField::signed(11, 11);
        $this->assertSame(11, $field->getScale());
    }

    public function testScaleTooSmall()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = DecimalField::signed(10, -1);
    }

    public function testScaleTooLarge()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = DecimalField::signed(10, 31);
    }

    public function testScaleLargerThanPrecision()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = DecimalField::signed(10, 11);
    }

    public function testMax()
    {
        $field = DecimalField::signed(10, 0);
        $field->set(9999999999);
    }

    public function testMaxInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = DecimalField::signed(10, 0);
        $field->set(10000000000);
    }

    public function testMin()
    {
        $field = DecimalField::signed(10, 0);
        $field->set(-9999999999);
    }

    public function testMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = DecimalField::signed(10, 0);
        $field->set(-10000000000);
    }
}
