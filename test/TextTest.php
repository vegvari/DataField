<?php

namespace Data\Field;

class TextTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $field = Text::make();
        $this->assertTrue($field->data instanceof \Data\Type\String);
        $this->assertSame(null, $field->data->value);
        $this->assertSame(false, $field->nullable);
    }

    public function testDefault()
    {
        $field = Text::make(1);
        $this->assertSame('1', $field->data->value);
    }

    public function testValue()
    {
        $field = Text::make();
        $field->set(1);
        $this->assertSame('1', $field->data->value);
    }

    public function testNullable()
    {
        $field = Text::nullable();
        $this->assertSame(null, $field->data->value);
        $this->assertSame(true, $field->nullable);
    }

    public function testMaxLengthValueTooLong()
    {
        $this->setExpectedException('\LengthException');
        $field = Text::make(str_repeat(' ', 65536));
    }
}
