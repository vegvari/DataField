<?php

namespace Data\Field;

class DateTimeTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $field = DateTime::make();
        $this->assertTrue($field->data instanceof \Data\Type\DateTime);
        $this->assertSame(false, $field->nullable);
    }

    public function testDefault()
    {
        $field = DateTime::make('now');
        $this->assertSame(date('c'), $field->data->value);
    }

    public function testSet()
    {
        $field = DateTime::make();
        $field->set('+1day');
        $this->assertSame(date('c', time() + 24 * 60 * 60), $field->data->value);
    }

    public function testNullable()
    {
        $field = DateTime::nullable();
        $this->assertSame(true, $field->nullable);
    }
}
