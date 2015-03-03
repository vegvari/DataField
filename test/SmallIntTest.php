<?php

namespace Data\Field;

class SmallIntTest extends \PHPUnit_Framework_TestCase
{
    public function testSignedMax()
    {
        $field = SmallInt::make(32767);
        $this->assertSame(32767, $field->data->value);
    }

    public function testSignedMaxInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = SmallInt::make(32767 + 1);
    }

    public function testSignedMin()
    {
        $field = SmallInt::make(-32767 - 1);
        $this->assertSame(-32767 - 1, $field->data->value);
    }

    public function testSignedMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = SmallInt::make(-32767 - 2);
    }

    public function testUnsignedMax()
    {
        $field = SmallInt::unsigned(32767 * 2 + 1);
        $this->assertSame(32767 * 2 + 1, $field->data->value);
    }

    public function testUnsignedMaxInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = SmallInt::unsigned(32767 * 2 + 2);
    }

    public function testUnsignedMin()
    {
        $field = SmallInt::unsigned(0);
        $this->assertSame(0, $field->data->value);
    }

    public function testUnsignedMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = SmallInt::unsigned(-1);
    }
}
