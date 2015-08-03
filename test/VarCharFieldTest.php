<?php

use Data\Type\StringType;
use Data\Field\VarCharField;

/**
 * @coversDefaultClass \Data\Field\VarCharField
 */
class VarCharFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function notNull()
    {
        $instance = new VarCharField('test', new StringType(), false, VarCharField::MAX_FIELD_LENGTH);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof StringType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(VarCharField::MAX_FIELD_LENGTH, $instance->getMaxLength());

        $instance = VarCharField::notNull('test', VarCharField::MAX_FIELD_LENGTH, 'UTF-8', '12');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof StringType);
        $this->assertSame('12', $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(VarCharField::MAX_FIELD_LENGTH, $instance->getMaxLength());
    }

    /**
     * @test
     */
    public function nullable()
    {
        $instance = new VarCharField('test', new StringType(), true, VarCharField::MAX_FIELD_LENGTH);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof StringType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(VarCharField::MAX_FIELD_LENGTH, $instance->getMaxLength());

        $instance = VarCharField::nullable('test', VarCharField::MAX_FIELD_LENGTH, 'UTF-8', '12');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof StringType);
        $this->assertSame('12', $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(VarCharField::MAX_FIELD_LENGTH, $instance->getMaxLength());
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
            [function () { return new VarCharField('test', new StringType(), false, null); }, 'InvalidArgumentException', 'Length must be positive int: ""'],
            [function () { return new VarCharField('test', new StringType(), false, ''); }, 'InvalidArgumentException', 'Length must be positive int: ""'],
            [function () { return new VarCharField('test', new StringType(), false, 'asdf'); }, 'InvalidArgumentException', 'Length must be positive int: "asdf"'],
            [function () { return new VarCharField('test', new StringType(), false, VarCharField::MAX_FIELD_LENGTH + 1); }, 'InvalidArgumentException', 'Length is greater than max length (' . VarCharField::MAX_FIELD_LENGTH . '): "' . (VarCharField::MAX_FIELD_LENGTH + 1) . '"'],
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
            [function () { return new VarCharField('test', new StringType(str_repeat('a', VarCharField::MAX_FIELD_LENGTH + 1)), false, VarCharField::MAX_FIELD_LENGTH); }, '\Data\Field\Exceptions\MaxLengthException'],
        ];
    }
}
