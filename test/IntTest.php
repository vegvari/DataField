<?php

namespace Data\Field;

use PHPUnit_Framework_TestCase;

class IntTest extends PHPUnit_Framework_TestCase
{
    public function testSignedDefault()
    {
        $field = IntField::signed();
        $this->assertSame(false, $field->isNullable());
        $this->assertSame(false, $field->isUnsigned());
    }

    public function testSignedMax()
    {
        $field = IntField::signed(2147483647);
        $this->assertSame(2147483647, $field->value());
    }

    public function testSignedMaxInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = IntField::signed(2147483647 + 1);
    }

    public function testSignedMin()
    {
        $field = IntField::signed(-2147483647 - 1);
        $this->assertSame(-2147483647 - 1, $field->value());
    }

    public function testSignedMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = IntField::signed(-2147483647 - 2);
    }

    public function testUnsignedMax()
    {
        $field = IntField::unsigned(2147483647 * 2 + 1);
        $this->assertSame(2147483647 * 2 + 1, $field->value());
    }

    public function testUnsignedMaxInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = IntField::unsigned(2147483647 * 2 + 2);
    }

    public function testUnsignedMin()
    {
        $field = IntField::unsigned(0);
        $this->assertSame(0, $field->value());
    }

    public function testUnsignedMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = IntField::unsigned(-1);
    }

    public function testNullable()
    {
        $field = IntField::nullable();
        $this->assertSame(true, $field->isNullable());
        $this->assertSame(false, $field->isUnsigned());
    }

    public function testUnsigned()
    {
        $field = IntField::unsigned();
        $this->assertSame(false, $field->isNullable());
        $this->assertSame(true, $field->isUnsigned());
    }

    public function testUnsignedInvalidDefault()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = IntField::unsigned(-1);
    }

    public function testUnsignedInvalidValue()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = IntField::unsigned();
        $field->set(-1);
    }

    public function testUnsignedNullable()
    {
        $field = IntField::unsignedNullable();
        $this->assertSame(true, $field->isNullable());
        $this->assertSame(true, $field->isUnsigned());
    }
}
