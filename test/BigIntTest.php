<?php

namespace Data\Field;

class BigIntTest extends \PHPUnit_Framework_TestCase
{
    public function testSignedMax()
    {
        $field = BigInt::make(2147483647);
        $this->assertSame(2147483647, $field->data->value);
    }

    public function testSignedMaxInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = BigInt::make(2147483647 + 1);
    }

    public function testSignedMin()
    {
        $field = BigInt::make(-2147483647 - 1);
        $this->assertSame(-2147483647 - 1, $field->data->value);
    }

    public function testSignedMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = BigInt::make(-21474836487 - 2);
    }

    public function testUnsignedMax()
    {
        $field = BigInt::unsigned(2147483647 * 2 + 1);
        $this->assertSame(2147483647 * 2 + 1, $field->data->value);
    }

    public function testUnsignedMaxInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = BigInt::unsigned(2147483647 * 2 + 2);
    }

    public function testUnsignedMin()
    {
        $field = BigInt::unsigned(0);
        $this->assertSame(0, $field->data->value);
    }

    public function testUnsignedMinInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $field = BigInt::unsigned(-1);
    }
}
