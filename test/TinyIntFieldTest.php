<?php

use Data\Field\TinyIntField;

/**
 * @coversDefaultClass \Data\Field\TinyIntField
 */
class TinyIntFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function construct()
    {
        $instance = TinyIntField::signedNotNull('test');
        $this->assertSame(TinyIntField::MIN_FIELD_VALUE_SIGNED, $instance->getMinValue());
        $this->assertSame(TinyIntField::MAX_FIELD_VALUE_SIGNED, $instance->getMaxValue());

        $instance = TinyIntField::signedNullable('test');
        $this->assertSame(TinyIntField::MIN_FIELD_VALUE_SIGNED, $instance->getMinValue());
        $this->assertSame(TinyIntField::MAX_FIELD_VALUE_SIGNED, $instance->getMaxValue());

        $instance = TinyIntField::unsignedNotNull('test');
        $this->assertSame(TinyIntField::MIN_FIELD_VALUE_UNSIGNED, $instance->getMinValue());
        $this->assertSame(TinyIntField::MAX_FIELD_VALUE_UNSIGNED, $instance->getMaxValue());

        $instance = TinyIntField::unsignedNullable('test');
        $this->assertSame(TinyIntField::MIN_FIELD_VALUE_UNSIGNED, $instance->getMinValue());
        $this->assertSame(TinyIntField::MAX_FIELD_VALUE_UNSIGNED, $instance->getMaxValue());

        $instance = TinyIntField::serial('test');
        $this->assertSame(TinyIntField::MIN_FIELD_VALUE_SERIAL, $instance->getMinValue());
        $this->assertSame(TinyIntField::MAX_FIELD_VALUE_SERIAL, $instance->getMaxValue());
    }
}
