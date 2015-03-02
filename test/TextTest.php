<?php

namespace Data\Field;

class TextTest extends \PHPUnit_Framework_TestCase
{
	public function testBasic()
	{
		$field = new Text();
		$this->assertTrue($field->data instanceof \Data\Type\String);
		$this->assertSame(null, $field->data->value);
		$this->assertSame(false, $field->nullable);
	}

	public function testDefault()
	{
		$field = new Text(1);
		$this->assertSame('1', $field->data->value);
	}

	public function testNullable()
	{
		$field = new Text(null, true);
		$this->assertSame(true, $field->nullable);
	}

	public function testNullableInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Text(null, 'a');
	}

	public function testMaxLengthValueTooLong()
	{
		$this->setExpectedException('\LengthException');
		$field = new Text(str_repeat(' ', 65536));
	}
}
