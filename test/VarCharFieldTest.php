<?php

use Data\Field\VarCharField;

/**
 * @coversDefaultClass \Data\Field\VarCharField
 */
class VarCharFieldTest extends PHPUnit_Framework_TestCase
{
    protected $max_field_length = 65535;

    /**
     * @test
     * @covers ::__construct
     */
    public function constructDefault()
    {
        $instance = new VarCharField(255, 'test', false, 'UTF-8');
        $this->assertSame('test', $instance->value());
    }

    /**
     * @test
     * @covers ::__construct
     */
    public function constructLengthMinFail()
    {
        $this->setExpectedException('InvalidArgumentException');
        $instance = new VarCharField(0, null, false, 'UTF-8');
    }

    /**
     * @test
     * @covers ::__construct
     */
    public function constructLengthMaxFail()
    {
        $this->setExpectedException('InvalidArgumentException');
        $instance = new VarCharField($this->max_field_length + 1 , null, false, 'UTF-8');
    }

    /**
     * @test
     * @covers ::__construct
     */
    public function constructNullableFail()
    {
        $this->setExpectedException('InvalidArgumentException');
        $instance = new VarCharField(255, null, 1, 'UTF-8');
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::notNull
     * @covers ::isNullable
     */
    public function notNull()
    {
        $instance = new VarCharField(255, null, false, 'UTF-8');
        $this->assertSame(false, $instance->isNullable());

        $instance = VarCharField::notNull(255);
        $this->assertSame(false, $instance->isNullable());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::nullable
     * @covers ::isNullable
     */
    public function nullable()
    {
        $instance = new VarCharField(255, null, true, 'UTF-8');
        $this->assertSame(true, $instance->isNullable());

        $instance = VarCharField::nullable(255);
        $this->assertSame(true, $instance->isNullable());
    }

    /**
     * @test
     * @covers ::check
     */
    public function check()
    {
        $instance = new VarCharField(4, null, false, 'UTF-8');
        $instance->set('test');
        $this->assertSame('test', $instance->value());
    }

    /**
     * @test
     * @covers ::check
     */
    public function checkFail()
    {
        $this->setExpectedException('LengthException');
        $instance = new VarCharField(4, null, false, 'UTF-8');
        $instance->set('test1');
    }
}
