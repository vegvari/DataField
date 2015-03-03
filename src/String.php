<?php

namespace Data\Field;

abstract class String extends Field
{
    protected static $maxLength = 4294967295;

    protected $data = '\Data\Type\String';

    public function set($value)
    {
        $data = $this->data->set($value);

        if ($this->nullable === true && $data->value === '') {
            $value = null;
        }

        parent::set($value);
    }

    protected function check()
    {
        if (static::$maxLength < $this->data->length) {
            throw new \LengthException('Length of the string (' . $this->data->length . ') is larger than maxLength (' . static::$maxLength . ')');
        }
    }
}
