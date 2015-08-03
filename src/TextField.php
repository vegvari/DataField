<?php

namespace Data\Field;

use Data\Type\StringType;

class TextField extends StringField
{
    /**
     * @var int
     */
    const MAX_FIELD_LENGTH = 65535;

    /**
     * Return the maximum length
     *
     * @return int
     */
    public function getMaxLength()
    {
        return static::MAX_FIELD_LENGTH;
    }

    /**
     * Create not null
     *
     * @param string $name
     * @param string $encoding
     * @param mixed  $default
     */
    public static function notNull($name, $encoding, $default = null)
    {
        return new static($name, new StringType($default, $encoding), false);
    }

    /**
     * Create nullable
     *
     * @param string $name
     * @param string $encoding
     * @param mixed  $default
     */
    public static function nullable($name, $encoding, $default = null)
    {
        return new static($name, new StringType($default, $encoding), true);
    }
}
