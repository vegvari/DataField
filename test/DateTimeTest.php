<?php

namespace Data\Field;

class DateTimeTest extends \PHPUnit_Framework_TestCase
{
	public function testBasic()
	{
		$field = new DateTime();
		$this->assertTrue($field->data instanceof \Data\Type\DateTime);
		$this->assertSame(false, $field->nullable);
	}

	public function testDefault()
	{
		$field = new DateTime('now');
		$this->assertSame(date('c'), $field->data->value);
	}

	public function testSet()
	{
		$field = new DateTime();
		$field->set('+1day');
		$this->assertSame(date('c', time() + 24 * 60 * 60), $field->data->value);
	}

	public function testNullable()
	{
		$field = new DateTime(null, true);
		$this->assertSame(true, $field->nullable);
	}

	public function testNullableInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new DateTime(null, 'a');
	}
}
