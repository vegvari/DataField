<?php

use Data\Type\StringType;
use Data\Field\CharField;

/**
 * @coversDefaultClass \Data\Field\CharField
 */
class CharFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function notNull()
    {
        $instance = new CharField('test', new StringType(), false, CharField::MAX_FIELD_LENGTH);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof StringType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(CharField::MAX_FIELD_LENGTH, $instance->getMaxLength());

        $instance = CharField::notNull('test', CharField::MAX_FIELD_LENGTH, 'UTF-8', '12');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof StringType);
        $this->assertSame('12', $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(CharField::MAX_FIELD_LENGTH, $instance->getMaxLength());
    }

    /**
     * @test
     */
    public function nullable()
    {
        $instance = new CharField('test', new StringType(), true, CharField::MAX_FIELD_LENGTH);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof StringType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(CharField::MAX_FIELD_LENGTH, $instance->getMaxLength());

        $instance = CharField::nullable('test', CharField::MAX_FIELD_LENGTH, 'UTF-8', '12');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof StringType);
        $this->assertSame('12', $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(CharField::MAX_FIELD_LENGTH, $instance->getMaxLength());
    }

    /**
     * @test
     * @dataProvider constructFailProvider
     */
    public function constructFail(Closure $closure, $expected, $message)
    {
        $this->setExpectedException($expected, $message);
        $closure();
    }

    public function constructFailProvider()
    {
        return [
            [function () { return new CharField('test', new StringType(), false, null); }, 'InvalidArgumentException', 'Length must be positive int: ""'],
            [function () { return new CharField('test', new StringType(), false, ''); }, 'InvalidArgumentException', 'Length must be positive int: ""'],
            [function () { return new CharField('test', new StringType(), false, 'asdf'); }, 'InvalidArgumentException', 'Length must be positive int: "asdf"'],
            [function () { return new CharField('test', new StringType(), false, CharField::MAX_FIELD_LENGTH + 1); }, 'InvalidArgumentException', 'Length is greater than max length (' . CharField::MAX_FIELD_LENGTH . '): "' . (CharField::MAX_FIELD_LENGTH + 1) . '"'],
        ];
    }

    /**
     * @test
     * @dataProvider checkFailProvider
     */
    public function checkFail(Closure $closure, $expected)
    {
        $this->setExpectedException($expected);
        $closure();
    }

    public function checkFailProvider()
    {
        return [
            [function () { return new CharField('test', new StringType(str_repeat('a', CharField::MAX_FIELD_LENGTH + 1)), false, CharField::MAX_FIELD_LENGTH); }, '\Data\Field\Exceptions\MaxLengthException'],
        ];
    }
}
