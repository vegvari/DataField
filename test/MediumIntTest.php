<?php

namespace Data\Field;

class MediumIntTest extends \PHPUnit_Framework_TestCase
{
    public function testSignedMax()
    {
        $field = MediumInt::make(8388607);
        $this->assertSame(8388607, $field->data->value);
    }

    public function testSignedMaxInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = MediumInt::make(8388607 + 1);
    }

    public function testSignedMin()
    {
        $field = MediumInt::make(-8388607 - 1);
        $this->assertSame(-8388607 - 1, $field->data->value);
    }

    public function testSignedMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = MediumInt::make(-8388607 - 2);
    }

    public function testUnsignedMax()
    {
        $field = MediumInt::unsigned(8388607 * 2 + 1);
        $this->assertSame(8388607 * 2 + 1, $field->data->value);
    }

    public function testUnsignedMaxInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = MediumInt::unsigned(8388607 * 2 + 2);
    }

    public function testUnsignedMin()
    {
        $field = MediumInt::unsigned(0);
        $this->assertSame(0, $field->data->value);
    }

    public function testUnsignedMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = MediumInt::unsigned(-1);
    }
}
