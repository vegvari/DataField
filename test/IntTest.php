<?php

namespace Data\Field;

class IntTest extends \PHPUnit_Framework_TestCase
{
	public function testBasic()
	{
		$field = new Int();
		$this->assertTrue($field->data instanceof \Data\Type\Int);
		$this->assertSame(false, $field->nullable);
		$this->assertSame(false, $field->unsigned);
		$this->assertSame(false, $field->primary);
	}

	public function testDefault()
	{
		$field = new Int(1);
		$this->assertSame(1, $field->data->value);
	}

	public function testNullable()
	{
		$field = new Int(null, true);
		$this->assertSame(true, $field->nullable);
	}

	public function testNullableInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Int(null, 'a');
	}

	public function testUnsigned()
	{
		$field = new Int(null, false, true);
		$this->assertSame(true, $field->unsigned);
	}

	public function testUnsignedInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Int(null, false, 'a');
	}

	public function testPrimary()
	{
		$field = new Int();
		$field->primary();
		$this->assertSame(true, $field->primary);
	}
}
