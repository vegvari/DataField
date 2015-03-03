<?php

namespace Data\Field;

class FloatTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $field = Float::make();
        $this->assertTrue($field->data instanceof \Data\Type\Float);
        $this->assertSame(false, $field->nullable);
        $this->assertSame(false, $field->unsigned);
    }

    public function testDefault()
    {
        $field = Float::make(1);
        $this->assertSame(1.0, $field->data->value);
    }

    public function testValue()
    {
        $field = Float::make();
        $field->set(1);
        $this->assertSame(1.0, $field->data->value);
    }

    public function testNullable()
    {
        $field = Float::nullable();
        $this->assertSame(true, $field->nullable);
        $this->assertSame(false, $field->unsigned);
    }

    public function testUnsigned()
    {
        $field = Float::unsigned();
        $this->assertSame(false, $field->nullable);
        $this->assertSame(true, $field->unsigned);
    }

    public function testUnsignedInvalidDefault()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Float::unsigned(-1);
    }

    public function testUnsignedInvalidValue()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Float::unsigned();
        $field->set(-1);
    }

    public function testUnsignedNullable()
    {
        $field = Float::unsignedNullable();
        $this->assertSame(true, $field->nullable);
        $this->assertSame(true, $field->unsigned);
    }
}
