<?php

namespace Data\Field;

class FloatTest extends \PHPUnit_Framework_TestCase
{
    public function testSignedDefault()
    {
        $field = FloatField::signed();
        $this->assertSame(false, $field->isNullable());
        $this->assertSame(false, $field->isUnsigned());
    }

    public function testUnsignedMin()
    {
        $field = FloatField::unsigned(0);
        $this->assertSame(0.0, $field->value());
    }

    public function testUnsignedMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = FloatField::unsigned(-1);
    }

    public function testNullable()
    {
        $field = FloatField::nullable();
        $this->assertSame(true, $field->isNullable());
        $this->assertSame(false, $field->isUnsigned());
    }

    public function testUnsigned()
    {
        $field = FloatField::unsigned();
        $this->assertSame(false, $field->isNullable());
        $this->assertSame(true, $field->isUnsigned());
    }

    public function testUnsignedInvalidDefault()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = FloatField::unsigned(-1);
    }

    public function testUnsignedInvalidValue()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = FloatField::unsigned();
        $field->set(-1);
    }

    public function testUnsignedNullable()
    {
        $field = FloatField::unsignedNullable();
        $this->assertSame(true, $field->isNullable());
        $this->assertSame(true, $field->isUnsigned());
    }
}
