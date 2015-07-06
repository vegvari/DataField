<?php

use Data\Field\IntField;

/**
 * @coversDefaultClass \Data\Field\IntField
 */
class IntFieldTest extends PHPUnit_Framework_TestCase
{
    protected $signed_min = -2147483648;
    protected $signed_max = 2147483647;

    protected $unsigned_min = 0;
    protected $unsigned_max = 4294967295;

    /**
     * @test
     * @covers ::__construct
     */
    public function constructDefault()
    {
        $instance = new IntField(1, false, false);
        $this->assertSame(1, $instance->value());
    }

    /**
     * @test
     * @covers ::__construct
     */
    public function constructNullableFail()
    {
        $this->setExpectedException('InvalidArgumentException');
        $instance = new IntField(null, 1, false);
    }

    /**
     * @test
     * @covers ::__construct
     */
    public function constructUnsignedFail()
    {
        $this->setExpectedException('InvalidArgumentException');
        $instance = new IntField(null, true, 1);
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
        $instance = new IntField(null, false, false);
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());

        $instance = IntField::signedNotNull();
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
        $instance = new IntField(null, true, false);
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());

        $instance = IntField::signedNullable();
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
        $instance = new IntField(null, false, true);
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());

        $instance = IntField::unsignedNotNull();
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
        $instance = new IntField(null, true, true);
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());

        $instance = IntField::unsignedNullable();
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
    }

    /**
     * @test
     * @covers ::check
     */
    public function signedNotNullMin()
    {
        $instance = IntField::signedNotNull($this->signed_min);
        $this->assertSame($this->signed_min, $instance->value());
    }

    /**
     * @test
     * @covers ::check
     */
    public function signedNotNullMinFail()
    {
        $this->setExpectedException('\Data\Field\Exceptions\MinException');
        $instance = IntField::signedNotNull($this->signed_min - 1);
    }

    /**
     * @test
     * @covers ::check
     */
    public function signedNotNullMax()
    {
        $instance = IntField::signedNotNull($this->signed_max);
        $this->assertSame($this->signed_max, $instance->value());
    }

    /**
     * @test
     * @covers ::check
     */
    public function signedNotNullMaxFail()
    {
        $this->setExpectedException('\Data\Field\Exceptions\MaxException');
        $instance = IntField::signedNotNull($this->signed_max + 1);
    }

    /**
     * @test
     * @covers ::check
     */
    public function unsignedNotNullMin()
    {
        $instance = IntField::unsignedNotNull($this->unsigned_min);
        $this->assertSame($this->unsigned_min, $instance->value());
    }

    /**
     * @test
     * @covers ::check
     */
    public function unsignedNotNullMinFail()
    {
        $this->setExpectedException('\Data\Field\Exceptions\MinException');
        $instance = IntField::unsignedNotNull($this->unsigned_min - 1);
    }

    /**
     * @test
     * @covers ::check
     */
    public function unsignedNotNullMax()
    {
        $instance = IntField::unsignedNotNull($this->unsigned_max);
        $this->assertSame($this->unsigned_max, $instance->value());
    }

    /**
     * @test
     * @covers ::check
     */
    public function unsignedNotNullMaxFail()
    {
        $this->setExpectedException('\Data\Field\Exceptions\MaxException');
        $instance = IntField::unsignedNotNull($this->unsigned_max + 1);
    }
}
