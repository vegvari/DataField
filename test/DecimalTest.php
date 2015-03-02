<?php

namespace Data\Field;

class DecimalTest extends \PHPUnit_Framework_TestCase
{
	public function testBasic()
	{
		$field = new Decimal();
		$this->assertTrue($field->data instanceof \Data\Type\Float);
		$this->assertSame(false, $field->nullable);
		$this->assertSame(false, $field->unsigned);
		$this->assertSame(10, $field->precision);
		$this->assertSame(2, $field->scale);
	}

	public function testDefault()
	{
		$field = new Decimal(10, 2, 1);
		$this->assertSame(1.0, $field->data->value);
	}

	public function testNullable()
	{
		$field = new Decimal(10, 2, null, true);
		$this->assertSame(true, $field->nullable);
	}

	public function testNullableInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Decimal(10, 2, null, 'a');
	}

	public function testUnsigned()
	{
		$field = new Decimal(10, 2, null, false, true);
		$this->assertSame(true, $field->unsigned);
	}

	public function testUnsignedInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Decimal(10, 2, null, false, 'a');
	}

	public function testPrecision()
	{
		$field = new Decimal(11);
		$this->assertSame(11, $field->precision);
	}

	public function testPrecisionTooSmall()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Decimal(0);
	}

	public function testPrecisionTooLarge()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Decimal(66);
	}

	public function testScale()
	{
		$field = new Decimal(11, 11);
		$this->assertSame(11, $field->scale);
	}

	public function testScaleTooSmall()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Decimal(10, -1);
	}

	public function testScaleTooLarge()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Decimal(10, 31);
	}

	public function testScaleLargerThanPrecision()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Decimal(10, 11);
	}

	public function testMax()
	{
		$field = new Decimal(10, 0);
		$field->set(9999999999);
	}

	public function testMaxInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Decimal(10, 0);
		$field->set(10000000000);
	}

	public function testMin()
	{
		$field = new Decimal(10, 0);
		$field->set(-9999999999);
	}

	public function testMinInvalid()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$field = new Decimal(10, 0);
		$field->set(-10000000000);
	}
}
