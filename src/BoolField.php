<?php

namespace Data\Field;

use Data\Type\BoolType;

class BoolField extends Field
{
    /**
     * @param string   $name
     * @param BoolType $data
     * @param bool     $nullable
     */
    public function __construct($name, BoolType $data, $nullable)
    {
        parent::__construct($name, $data, $nullable);
    }

    /**
     * Check the value of the data when it's changing
     */
    protected function check()
    {
    }

    /**
     * Create not null
     *
     * @param string $name
     * @param mixed  $default
     */
    public static function notNull($name, $default = null)
    {
        return new static($name, new BoolType($default), false);
    }

    /**
     * Create nullable
     *
     * @param string $name
     * @param mixed  $default
     */
    public static function nullable($name, $default = null)
    {
        return new static($name, new BoolType($default), true);
    }
}
