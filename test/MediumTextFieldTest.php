<?php

use Data\Field\MediumTextField;

/**
 * @coversDefaultClass \Data\Field\MediumTextField
 */
class MediumTextFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function construct()
    {
        $instance = MediumTextField::notNull('test', 'UTF-8');
        $this->assertSame(MediumTextField::MAX_FIELD_LENGTH, $instance->getMaxLength());

        $instance = MediumTextField::nullable('test', 'UTF-8');
        $this->assertSame(MediumTextField::MAX_FIELD_LENGTH, $instance->getMaxLength());
    }
}
