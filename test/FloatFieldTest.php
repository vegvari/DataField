<?php

use Data\Field\FloatField;

/**
 * @coversDefaultClass \Data\Field\FloatField
 */
class FloatFieldTest extends PHPUnit_Framework_TestCase
{
    protected $unsigned_min = 0.0;

    /**
     * @test
     * @covers ::__construct
     */
    public function constructDefault()
    {
        $instance = new FloatField(1, false, false);
        $this->assertSame(1.0, $instance->value());
    }

    /**
     * @test
     * @covers ::__construct
     */
    public function constructNullableFail()
    {
        $this->setExpectedException('InvalidArgumentException');
        $instance = new FloatField(null, 1, false);
    }

    /**
     * @test
     * @covers ::__construct
     */
    public function constructUnsignedFail()
    {
        $this->setExpectedException('InvalidArgumentException');
        $instance = new FloatField(null, true, 1);
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::signedNotNull
     * @covers ::isNullable
     * @covers ::isUnsigned
     */
    public function signedNotNull()
    {
        $instance = new FloatField(null, false, false);
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());

        $instance = FloatField::signedNotNull();
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::signedNullable
     * @covers ::isNullable
     * @covers ::isUnsigned
     */
    public function signedNullable()
    {
        $instance = new FloatField(null, true, false);
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());

        $instance = FloatField::signedNullable();
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::unsignedNotNull
     * @covers ::isNullable
     * @covers ::isUnsigned
     */
    public function unsignedNotNull()
    {
        $instance = new FloatField(null, false, true);
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());

        $instance = FloatField::unsignedNotNull();
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::unsignedNullable
     * @covers ::isNullable
     * @covers ::isUnsigned
     */
    public function unsignedNullable()
    {
        $instance = new FloatField(null, true, true);
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());

        $instance = FloatField::unsignedNullable();
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
    }

    /**
     * @test
     * @covers ::check
     */
    public function unsignedNotNullMin()
    {
        $instance = FloatField::unsignedNotNull($this->unsigned_min);
        $this->assertSame($this->unsigned_min, $instance->value());
    }

    /**
     * @test
     * @covers ::check
     */
    public function unsignedNotNullMinFail()
    {
        $this->setExpectedException('\Data\Field\Exceptions\MinException');
        $instance = FloatField::unsignedNotNull($this->unsigned_min - 1);
    }
}
