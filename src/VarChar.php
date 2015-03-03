<?php

namespace Data\Field;

class VarChar extends String
{
    protected static $maxLength = 65535;

    protected $length = 255;

    protected function __construct($length = 255, $default = null, $nullable = false)
    {
        $this->length = \Data\Type\Int::castPositive($length);

        if ($this->length < 0) {
            throw new \InvalidArgumentException('Length must be 0 or positive integer, ' . $this->length . ' given');
        }

        if ($this->length > static::$maxLength) {
            throw new \InvalidArgumentException('Length (' . $this->length . ') is larger than maxLength (' . static::$maxLength . ')');
        }

        parent::__construct($default, $nullable);
    }

    public static function make($length, $default = null)
    {
        $class = get_called_class();
        $instance = new $class($length, $default, false);
        return $instance;
    }

    public static function nullable($length, $default = null)
    {
        $class = get_called_class();
        $instance = new $class($length, $default, true);
        return $instance;
    }

    protected function check()
    {
        if ($this->length < $this->data->length) {
            throw new \LengthException('Length of the string (' . $this->data->length . ') is larger than length of the field (' . $this->length . ')');
        }
    }
}
