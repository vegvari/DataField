<?php

namespace Data\Field;

class FloatTest extends \PHPUnit_Framework_TestCase
{
	public function testBasic()
	{
		$field = new Float();
		$this->assertTrue($field->data instanceof \Data\Type\Float);
		$this->assertSame(false, $field->nullable);
		$this->assertSame(false, $field->unsigned);
	}

	public function testDefault()
	{
		$field = new Float(1);
		$this->assertSame(1.0, $field->data->value);
	}

	public function testNullable()
	{
		$field = new Float(null, true);
		$this->assertSame(true, $field->nullable);
	}

	public function testNullableInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Float(null, 'a');
	}

	public function testUnsigned()
	{
		$field = new Float(null, false, true);
		$this->assertSame(true, $field->unsigned);
	}

	public function testUnsignedInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Float(null, false, 'a');
	}
}
