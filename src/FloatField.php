<?php

namespace Data\Field;

use Data\Type\FloatType;

class FloatField extends NumberField
{
    /**
     * @param string    $name
     * @param FloatType $data
     * @param bool      $nullable
     * @param bool      $unsigned
     */
    public function __construct($name, FloatType $data, $nullable, $unsigned)
    {
        parent::__construct($name, $data, $nullable, $unsigned);
    }

    /**
     * Create signed, not null
     *
     * @param string $name
     * @param mixed  $default
     */
    public static function signedNotNull($name, $default = null)
    {
        return new static($name, new FloatType($default), false, false);
    }

    /**
     * Create signed, nullable
     *
     * @param string $name
     * @param mixed  $default
     */
    public static function signedNullable($name, $default = null)
    {
        return new static($name, new FloatType($default), true, false);
    }

    /**
     * Create unsigned, not null
     *
     * @param string $name
     * @param mixed  $default
     */
    public static function unsignedNotNull($name, $default = null)
    {
        return new static($name, new FloatType($default), false, true);
    }

    /**
     * Create unsigned, nullable
     *
     * @param string $name
     * @param mixed  $default
     */
    public static function unsignedNullable($name, $default = null)
    {
        return new static($name, new FloatType($default), true, true);
    }
}
