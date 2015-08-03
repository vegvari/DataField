<?php

use Data\Field\MediumIntField;

/**
 * @coversDefaultClass \Data\Field\MediumIntField
 */
class MediumIntFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function construct()
    {
        $instance = MediumIntField::signedNotNull('test');
        $this->assertSame(MediumIntField::MIN_FIELD_VALUE_SIGNED, $instance->getMinValue());
        $this->assertSame(MediumIntField::MAX_FIELD_VALUE_SIGNED, $instance->getMaxValue());

        $instance = MediumIntField::signedNullable('test');
        $this->assertSame(MediumIntField::MIN_FIELD_VALUE_SIGNED, $instance->getMinValue());
        $this->assertSame(MediumIntField::MAX_FIELD_VALUE_SIGNED, $instance->getMaxValue());

        $instance = MediumIntField::unsignedNotNull('test');
        $this->assertSame(MediumIntField::MIN_FIELD_VALUE_UNSIGNED, $instance->getMinValue());
        $this->assertSame(MediumIntField::MAX_FIELD_VALUE_UNSIGNED, $instance->getMaxValue());

        $instance = MediumIntField::unsignedNullable('test');
        $this->assertSame(MediumIntField::MIN_FIELD_VALUE_UNSIGNED, $instance->getMinValue());
        $this->assertSame(MediumIntField::MAX_FIELD_VALUE_UNSIGNED, $instance->getMaxValue());

        $instance = MediumIntField::serial('test');
        $this->assertSame(MediumIntField::MIN_FIELD_VALUE_SERIAL, $instance->getMinValue());
        $this->assertSame(MediumIntField::MAX_FIELD_VALUE_SERIAL, $instance->getMaxValue());
    }
}
