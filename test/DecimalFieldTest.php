<?php

use Data\Field\DecimalField;

/**
 * @coversDefaultClass \Data\Field\DecimalField
 */
class DecimalFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers ::__construct
     */
    public function constructDefault()
    {
        $instance = new DecimalField(10, 2, 1, false, false);
        $this->assertSame(1.0, $instance->value());
    }

    /**
     * @test
     * @covers ::__construct
     */
    public function constructNullableFail()
    {
        $this->setExpectedException('InvalidArgumentException');
        $instance = new DecimalField(10, 2, null, 1, false);
    }

    /**
     * @test
     * @covers ::__construct
     */
    public function constructUnsignedFail()
    {
        $this->setExpectedException('InvalidArgumentException');
        $instance = new DecimalField(10, 2, null, false, 1);
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::signedNotNull
     * @covers ::isNullable
     * @covers ::isUnsigned
     * @covers ::getPrecision
     * @covers ::getScale
     */
    public function signedNotNull()
    {
        $instance = new DecimalField(10, 2, null, false, false);
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
        $this->assertSame(10,    $instance->getPrecision());
        $this->assertSame(2,     $instance->getScale());

        $instance = DecimalField::signedNotNull();
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
        $this->assertSame(10,    $instance->getPrecision());
        $this->assertSame(2,     $instance->getScale());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::signedNullable
     * @covers ::isNullable
     * @covers ::isUnsigned
     * @covers ::getPrecision
     * @covers ::getScale
     */
    public function signedNullable()
    {
        $instance = new DecimalField(10, 2, null, true, false);
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
        $this->assertSame(10,    $instance->getPrecision());
        $this->assertSame(2,     $instance->getScale());

        $instance = DecimalField::signedNullable();
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(false, $instance->isUnsigned());
        $this->assertSame(10,    $instance->getPrecision());
        $this->assertSame(2,     $instance->getScale());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::unsignedNotNull
     * @covers ::isNullable
     * @covers ::isUnsigned
     * @covers ::getPrecision
     * @covers ::getScale
     * @covers ::getFieldMin
     */
    public function unsignedNotNull()
    {
        $instance = new DecimalField(10, 2, null, false, true);
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(10,    $instance->getPrecision());
        $this->assertSame(2,     $instance->getScale());
        $this->assertSame(0.0,   $instance->getFieldMin());

        $instance = DecimalField::unsignedNotNull();
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(10,    $instance->getPrecision());
        $this->assertSame(2,     $instance->getScale());
        $this->assertSame(0.0,   $instance->getFieldMin());
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::unsignedNullable
     * @covers ::isNullable
     * @covers ::isUnsigned
     * @covers ::getPrecision
     * @covers ::getScale
     * @covers ::getFieldMin
     */
    public function unsignedNullable()
    {
        $instance = new DecimalField(10, 2, null, true, true);
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(10,    $instance->getPrecision());
        $this->assertSame(2,     $instance->getScale());
        $this->assertSame(0.0,   $instance->getFieldMin());

        $instance = DecimalField::unsignedNullable();
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(true, $instance->isUnsigned());
        $this->assertSame(10,    $instance->getPrecision());
        $this->assertSame(2,     $instance->getScale());
        $this->assertSame(0.0,   $instance->getFieldMin());
    }

    /**
     * @return array
     */
    public function precisionAndScaleProvider()
    {
        return [
            [['precision' => 3,  'scale' => 3,  'min' => -1.0,           'max' => 1.0]],
            [['precision' => 10, 'scale' => 3,  'min' => -10000000.0,    'max' => 10000000.0]],
            [['precision' => 10, 'scale' => 2,  'min' => -100000000.0,   'max' => 100000000.0]],
            [['precision' => 12, 'scale' => 10, 'min' => -100.0,         'max' => 100.0]],
            [['precision' => 12, 'scale' => 2,  'min' => -10000000000.0, 'max' => 10000000000.0]],
        ];

        return $result;
    }

    /**
     * @test
     * @dataProvider precisionAndScaleProvider
     * @covers       ::__construct
     * @covers       ::getFieldMin
     * @covers       ::getFieldMax
     * @covers       ::check
     */
    public function precisionAndScale(array $data)
    {
        $instance = new DecimalField($data['precision'], $data['scale'], null, false, false);
        $this->assertSame($data['min'], $instance->getFieldMin());
        $this->assertSame($data['max'], $instance->getFieldMax());

        $instance->set($data['min'] + 0.1);
        $this->assertGreaterThan($data['min'], $instance->value());

        $instance->set($data['max'] - 0.1);
        $this->assertLessThan($data['max'], $instance->value());
    }

    /**
     * @test
     * @dataProvider precisionAndScaleProvider
     * @covers       ::check
     */
    public function precisionAndScaleMinFail(array $data)
    {
        $this->setExpectedException('Data\Field\Exceptions\MinException');
        $instance = DecimalField::signedNotNull($data['precision'], $data['scale']);
        $instance->set($data['min']);
    }

    /**
     * @test
     * @dataProvider precisionAndScaleProvider
     * @covers       ::check
     */
    public function precisionAndScaleMaxFail(array $data)
    {
        $this->setExpectedException('Data\Field\Exceptions\MaxException');
        $instance = DecimalField::signedNotNull($data['precision'], $data['scale']);
        $instance->set($data['max']);
    }

    /**
     * @test
     * @covers ::check
     */
    public function precisionAndScaleUnsignedMinFail()
    {
        $this->setExpectedException('Data\Field\Exceptions\MinException');
        $instance = DecimalField::unsignedNotNull();
        $instance->set(-1);
    }

    /**
     * @test
     * @dataProvider precisionAndScaleConstructFailProvider
     * @covers       ::__construct
     */
    public function precisionAndScaleConstructFail($precision, $scale)
    {
        $this->setExpectedException('InvalidArgumentException');
        $instance = DecimalField::signedNotNull($precision, $scale);
    }

    /**
     * @return array
     */
    public function precisionAndScaleConstructFailProvider()
    {
        return [
            [null, 0],
            [1, null],
            [0, 0],
            [66, 0],
            [1, -1],
            [1, 31],
            [1, 2],
        ];
    }
}
