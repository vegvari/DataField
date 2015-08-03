<?php

use Data\Field\BigIntField;

/**
 * @coversDefaultClass \Data\Field\BigIntField
 */
class BigIntFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function construct()
    {
        $instance = BigIntField::signedNotNull('test');
        $this->assertSame(BigIntField::MIN_FIELD_VALUE_SIGNED, $instance->getMinValue());
        $this->assertSame(BigIntField::MAX_FIELD_VALUE_SIGNED, $instance->getMaxValue());

        $instance = BigIntField::signedNullable('test');
        $this->assertSame(BigIntField::MIN_FIELD_VALUE_SIGNED, $instance->getMinValue());
        $this->assertSame(BigIntField::MAX_FIELD_VALUE_SIGNED, $instance->getMaxValue());

        $instance = BigIntField::unsignedNotNull('test');
        $this->assertSame(BigIntField::MIN_FIELD_VALUE_UNSIGNED, $instance->getMinValue());
        $this->assertSame(BigIntField::MAX_FIELD_VALUE_UNSIGNED, $instance->getMaxValue());

        $instance = BigIntField::unsignedNullable('test');
        $this->assertSame(BigIntField::MIN_FIELD_VALUE_UNSIGNED, $instance->getMinValue());
        $this->assertSame(BigIntField::MAX_FIELD_VALUE_UNSIGNED, $instance->getMaxValue());

        $instance = BigIntField::serial('test');
        $this->assertSame(BigIntField::MIN_FIELD_VALUE_SERIAL, $instance->getMinValue());
        $this->assertSame(BigIntField::MAX_FIELD_VALUE_SERIAL, $instance->getMaxValue());
    }
}
