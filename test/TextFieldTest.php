<?php

use Data\Type\StringType;
use Data\Field\TextField;

/**
 * @coversDefaultClass \Data\Field\TextField
 */
class TextFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function notNull()
    {
        $instance = new TextField('test', new StringType(), false);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof StringType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(TextField::MAX_FIELD_LENGTH, $instance->getMaxLength());

        $instance = TextField::notNull('test', 'UTF-8', '12');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof StringType);
        $this->assertSame('12', $instance->getDefault());
        $this->assertSame(false, $instance->isNullable());
        $this->assertSame(TextField::MAX_FIELD_LENGTH, $instance->getMaxLength());
    }

    /**
     * @test
     */
    public function nullable()
    {
        $instance = new TextField('test', new StringType(), true);
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof StringType);
        $this->assertSame(null, $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(TextField::MAX_FIELD_LENGTH, $instance->getMaxLength());

        $instance = TextField::nullable('test', 'UTF-8', '12');
        $this->assertSame('test', $instance->getName());
        $this->assertSame(true, $instance->getData() instanceof StringType);
        $this->assertSame('12', $instance->getDefault());
        $this->assertSame(true, $instance->isNullable());
        $this->assertSame(TextField::MAX_FIELD_LENGTH, $instance->getMaxLength());
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
            [function () { return new TextField('test', new StringType(str_repeat('a', TextField::MAX_FIELD_LENGTH + 1)), false); }, '\Data\Field\Exceptions\MaxLengthException'],
        ];
    }
}
