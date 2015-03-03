<?php

namespace Data\Field;

class CharTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $field = Char::make(255);
        $this->assertTrue($field->data instanceof \Data\Type\String);
        $this->assertSame(null, $field->data->value);
        $this->assertSame(false, $field->nullable);
        $this->assertSame(255, $field->length);
    }

    public function testDefault()
    {
        $field = Char::make(255, 1);
        $this->assertSame('1', $field->data->value);
        $this->assertSame(false, $field->nullable);
        $this->assertSame(255, $field->length);
    }

    public function testNullable()
    {
        $field = Char::nullable(255);
        $this->assertSame(null, $field->data->value);
        $this->assertSame(true, $field->nullable);
        $this->assertSame(255, $field->length);
    }

    public function testLength()
    {
        $field = Char::make(10, 1);
        $this->assertSame('1', $field->data->value);
        $this->assertSame(false, $field->nullable);
        $this->assertSame(10, $field->length);
    }

    public function testLengthInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Char::make(-1);
    }

    public function testLengthLargerThanMax()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = Char::make(256);
    }

    public function testLengthValueTooLong()
    {
        $this->setExpectedException('\LengthException');
        $field = Char::make(10, str_repeat(' ', 11));
    }
}
