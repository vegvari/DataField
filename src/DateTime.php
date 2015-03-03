<?php

namespace Data\Field;

class DateTime extends Field
{
    protected $data = '\Data\Type\DateTime';

    public function __construct($default = null, $nullable = false, $timezone = 'UTC')
    {
        parent::__construct($default, $nullable);

        $this->data->timezone($timezone);
    }

    public static function make($default = null, $timezone = 'UTC')
    {
        $class = get_called_class();
        $instance = new $class($default, false, $timezone);
        return $instance;
    }

    public static function nullable($default = null, $timezone = 'UTC')
    {
        $class = get_called_class();
        $instance = new $class($default, true, $timezone);
        return $instance;
    }
}
