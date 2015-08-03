<?php

use Data\Field\TinyTextField;

/**
 * @coversDefaultClass \Data\Field\TinyTextField
 */
class TinyTextFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function construct()
    {
    	$instance = TinyTextField::nullable('test', 'UTF-8');
        $this->assertSame(TinyTextField::MAX_FIELD_LENGTH, $instance->getMaxLength());

        $instance = TinyTextField::nullable('test', 'UTF-8');
        $this->assertSame(TinyTextField::MAX_FIELD_LENGTH, $instance->getMaxLength());
    }
}
