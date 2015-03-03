<?php

namespace Data\Field;

class Text extends String
{
    protected static $maxLength = 65535;

    public static function make($default = null)
    {
        $class = get_called_class();
        $instance = new $class($default, false);
        return $instance;
    }

    public static function nullable($default = null)
    {
        $class = get_called_class();
        $instance = new $class($default, true);
        return $instance;
    }
}
