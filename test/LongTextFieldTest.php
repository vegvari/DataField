<?php

use Data\Field\LongTextField;

/**
 * @coversDefaultClass \Data\Field\LongTextField
 */
class LongTextFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function construct()
    {
        $instance = LongTextField::notNull('test', 'UTF-8');
        $this->assertSame(LongTextField::MAX_FIELD_LENGTH, $instance->getMaxLength());

        $instance = LongTextField::nullable('test', 'UTF-8');
        $this->assertSame(LongTextField::MAX_FIELD_LENGTH, $instance->getMaxLength());
    }
}
