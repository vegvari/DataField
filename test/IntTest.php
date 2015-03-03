<?php

namespace Data\Field;

class IntTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $field = Int::make();
        $this->assertTrue($field->data instanceof \Data\Type\Int);
        $this->assertSame(false, $field->nullable);
        $this->assertSame(false, $field->unsigned);
        $this->assertSame(false, $field->serial);
    }

    public function testDefault()
    {
        $field = Int::make(1);
        $this->assertSame(1, $field->data->value);
    }

    public function testValue()
    {
        $field = Int::make();
        $field->set(1);
        $this->assertSame(1, $field->data->value);
    }

    public function testNullable()
    {
        $field = Int::nullable();
        $this->assertSame(true, $field->nullable);
        $this->assertSame(false, $field->unsigned);
        $this->assertSame(false, $field->serial);
    }

    public function testUnsigned()
    {
        $field = Int::unsigned();
        $this->assertSame(false, $field->nullable);
        $this->assertSame(true, $field->unsigned);
        $this->assertSame(false, $field->serial);
    }

    public function testUnsignedInvalidDefault()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Int::unsigned(-1);
    }

    public function testUnsignedInvalidValue()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Int::unsigned();
        $field->set(-1);
    }

    public function testUnsignedNullable()
    {
        $field = Int::unsignedNullable();
        $this->assertSame(true, $field->nullable);
        $this->assertSame(true, $field->unsigned);
        $this->assertSame(false, $field->serial);
    }

    public function testSerial()
    {
        $field = Int::serial();
        $this->assertSame(false, $field->nullable);
        $this->assertSame(true, $field->unsigned);
        $this->assertSame(true, $field->serial);
    }

    public function testSerialInvalidValue()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Int::serial();
        $field->set(0);
    }
}
