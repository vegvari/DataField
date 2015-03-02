<?php

namespace Data\Field;

class CharTest extends \PHPUnit_Framework_TestCase
{
	public function testBasic()
	{
		$field = new Char();
		$this->assertTrue($field->data instanceof \Data\Type\String);
		$this->assertSame(null, $field->data->value);
		$this->assertSame(false, $field->nullable);
		$this->assertSame(255, $field->length);
	}

	public function testDefault()
	{
		$field = new Char(255, 1);
		$this->assertSame('1', $field->data->value);
	}

	public function testNullable()
	{
		$field = new Char(255, null, true);
		$this->assertSame(true, $field->nullable);
	}

	public function testNullableInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Char(255, null, 'a');
	}

	public function testLength()
	{
		$field = new Char(10);
		$this->assertSame(10, $field->length);
	}

	public function testLengthInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Char(-1);
	}

	public function testLengthLargerThanMax()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Char(256);
	}

	public function testLengthValueTooLong()
	{
		$this->setExpectedException('\LengthException');
		$field = new VarChar(10, str_repeat(' ', 11));
	}

	public function testMaxLengthValueTooLong()
	{
		$this->setExpectedException('\LengthException');
		$field = new Char(255, str_repeat(' ', 256));
	}
}
