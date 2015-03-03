<?php

namespace Data\Field;

class TinyIntTest extends \PHPUnit_Framework_TestCase
{
    public function testSignedMax()
    {
        $field = TinyInt::make(127);
        $this->assertSame(127, $field->data->value);
    }

    public function testSignedMaxInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = TinyInt::make(127 + 1);
    }

    public function testSignedMin()
    {
        $field = TinyInt::make(-127 - 1);
        $this->assertSame(-127 - 1, $field->data->value);
    }

    public function testSignedMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = TinyInt::make(-127 - 2);
    }

    public function testUnsignedMax()
    {
        $field = TinyInt::unsigned(127 * 2 + 1);
        $this->assertSame(127 * 2 + 1, $field->data->value);
    }

    public function testUnsignedMaxInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = TinyInt::unsigned(127 * 2 + 2);
    }

    public function testUnsignedMin()
    {
        $field = TinyInt::unsigned(0);
        $this->assertSame(0, $field->data->value);
    }

    public function testUnsignedMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = TinyInt::unsigned(-1);
    }
}
