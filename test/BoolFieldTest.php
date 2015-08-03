<?php

use Data\Type\BoolType;
use Data\Field\BoolField;

/**
 * @coversDefaultClass \Data\Field\BoolField
 */
class BoolFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function notNull()
    {
        $instance = new BoolField('test', new BoolType(), false);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof BoolType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());

        $instance = BoolField::notNull('test', true);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof BoolType);
        $this->assertSame(true, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
    }

    /**
     * @test
     */
    public function nullable()
    {
        $instance = new BoolField('test', new BoolType(), true);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof BoolType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());

        $instance = BoolField::nullable('test', true);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof BoolType);
        $this->assertSame(true, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
    }
}
