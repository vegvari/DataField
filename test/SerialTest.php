<?php

namespace Data\Field;

class SerialTest extends \PHPUnit_Framework_TestCase
{
	public function testBasic()
	{
		$field = new Serial();
		$this->assertTrue($field->data instanceof \Data\Type\Int);
		$this->assertSame(false, $field->nullable);
		$this->assertSame(true, $field->unsigned);
		$this->assertSame(true, $field->primary);
		$this->assertSame(true, $field->serial);
	}

	public function testDefault()
	{
		$field = new Serial(1);
		$this->assertSame(1, $field->data->value);
	}

	public function testNullableInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Serial(null, true);
	}

	public function testUnsignedInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Serial(null, true, true);
	}

	public function testPrimary()
	{
		$field = new Serial();
		$field->primary();
		$this->assertSame(true, $field->primary);
	}
}