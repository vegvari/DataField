<?php

namespace Data\Field;

use Data\Type\DateTimeType;

class DateTimeField extends Field
{
    /**
     * @param string       $name
     * @param DateTimeType $data
     * @param bool         $nullable
     */
    public function __construct($name, DateTimeType $data, $nullable)
    {
        parent::__construct($name, $data, $nullable);
    }

    /**
     * Check the value of the data when it's changing
     */
    public function check()
    {
    }

    /**
     * Create not null
     *
     * @param string $name
     * @param mixed  $default
     */
    public static function notNull($name, $timezone, $default = null)
    {
        return new static($name, new DateTimeType($default, $timezone), false);
    }

    /**
     * Create nullable
     *
     * @param string $name
     * @param mixed  $default
     */
    public static function nullable($name, $timezone, $default = null)
    {
        return new static($name, new DateTimeType($default, $timezone), true);
    }
}
