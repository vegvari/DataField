<?php

namespace Data\Field;

use Data\Type\StringType;
use InvalidArgumentException;

class CharField extends StringField
{
    /**
     * @var int
     */
    const MAX_FIELD_LENGTH = 255;

    /**
     * @var int
     */
    protected $max_length;

    /**
     * @param string     $name
     * @param StringType $default
     * @param bool       $nullable
     * @param int        $length
     */
    public function __construct($name, StringType $data, $nullable, $length)
    {
        if (! is_int($length) || $length < 1) {
            throw new InvalidArgumentException('Length must be positive int: "' . $length . '"');
        }

        if ($length > static::MAX_FIELD_LENGTH) {
            throw new InvalidArgumentException('Length is greater than max length (' . static::MAX_FIELD_LENGTH . '): "' . $length . '"');
        }

        $this->max_length = (int) $length;

        parent::__construct($name, $data, $nullable);
    }

    /**
     * Return the maximum length
     *
     * @return int
     */
    public function getMaxLength()
    {
        return $this->max_length;
    }

    /**
     * Create not null
     *
     * @param string $name
     * @param int    $length
     * @param string $encoding
     * @param mixed  $default
     */
    public static function notNull($name, $length, $encoding, $default = null)
    {
        return new static($name, new StringType($default, $encoding), false, $length);
    }

    /**
     * Create nullable
     *
     * @param string $name
     * @param int    $length
     * @param string $encoding
     * @param mixed  $default
     */
    public static function nullable($name, $length, $encoding, $default = null)
    {
        return new static($name, new StringType($default, $encoding), true, $length);
    }
}
