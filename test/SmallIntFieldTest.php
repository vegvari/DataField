<?php

use Data\Field\SmallIntField;

/**
 * @coversDefaultClass \Data\Field\SmallIntField
 */
class SmallIntFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function construct()
    {
        $instance = SmallIntField::signedNotNull('test');
        $this->assertSame(SmallIntField::MIN_FIELD_VALUE_SIGNED, $instance->getMinValue());
        $this->assertSame(SmallIntField::MAX_FIELD_VALUE_SIGNED, $instance->getMaxValue());

        $instance = SmallIntField::signedNullable('test');
        $this->assertSame(SmallIntField::MIN_FIELD_VALUE_SIGNED, $instance->getMinValue());
        $this->assertSame(SmallIntField::MAX_FIELD_VALUE_SIGNED, $instance->getMaxValue());

        $instance = SmallIntField::unsignedNotNull('test');
        $this->assertSame(SmallIntField::MIN_FIELD_VALUE_UNSIGNED, $instance->getMinValue());
        $this->assertSame(SmallIntField::MAX_FIELD_VALUE_UNSIGNED, $instance->getMaxValue());

        $instance = SmallIntField::unsignedNullable('test');
        $this->assertSame(SmallIntField::MIN_FIELD_VALUE_UNSIGNED, $instance->getMinValue());
        $this->assertSame(SmallIntField::MAX_FIELD_VALUE_UNSIGNED, $instance->getMaxValue());

        $instance = SmallIntField::serial('test');
        $this->assertSame(SmallIntField::MIN_FIELD_VALUE_SERIAL, $instance->getMinValue());
        $this->assertSame(SmallIntField::MAX_FIELD_VALUE_SERIAL, $instance->getMaxValue());
    }
}
