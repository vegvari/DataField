<?php

use Data\Type\DateTimeType;
use Data\Field\DateTimeField;

/**
 * @coversDefaultClass \Data\Field\DateTimeField
 */
class DateTimeFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function notNull()
    {
        $instance = new DateTimeField('test', new DateTimeType(), false);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof DateTimeType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());

        $instance = DateTimeField::notNull('test', 'UTC', '2013-06-09');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof DateTimeType);
        $this->assertSame('2013-06-09 00:00:00', $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
    }

    /**
     * @test
     */
    public function nullable()
    {
        $instance = new DateTimeField('test', new DateTimeType(), true);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof DateTimeType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());

        $instance = DateTimeField::nullable('test', 'UTC', '2013-06-09');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof DateTimeType);
        $this->assertSame('2013-06-09 00:00:00', $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
    }
}
