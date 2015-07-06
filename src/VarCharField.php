<?php

namespace Data\Field;

use Data\Type\StringType;

use LengthException;
use InvalidArgumentException;

class VarCharField extends StringType
{
    /**
     * @var int
     */
    protected static $max_field_length = 65535;

    /**
     * @var int
     */
    protected $field_length;

    /**
     * @var bool
     */
    protected $nullable;

    /**
     * @param int   $length
     * @param mixed $default
     * @param bool  $nullable
     */
    public function __construct($length, $default, $nullable, $encoding)
    {
        if ($length < 1) {
            throw new InvalidArgumentException('Length must be a positive integer, "' . $length . '" given');
        }

        if ($length > static::$max_field_length) {
            throw new InvalidArgumentException('Length is greater than max length (' . static::$max_field_length . '): "' . $length . '"');
        }
        $this->field_length = (int) $length;

        if ($nullable !== false && $nullable !== true) {
            throw new InvalidArgumentException('Nullable must be bool');
        }
        $this->nullable = $nullable;

        parent::__construct($default, $encoding);
    }

    /**
     * Create not null
     *
     * @param int   $length
     * @param mixed $default
     */
    public static function notNull($length, $default = null, $encoding = null)
    {
        return new static($length, $default, false, $encoding);
    }

    /**
     * Create nullable
     *
     * @param int   $length
     * @param mixed $default
     */
    public static function nullable($length, $default = null, $encoding = null)
    {
        return new static($length, $default, true, $encoding);
    }

    /**
     * Return the nullable property
     *
     * @return bool
     */
    public function isNullable()
    {
        return $this->nullable;
    }

    /**
     * Check the value
     *
     * @param  mixed       $value
     * @return string|null
     */
    protected function check($value)
    {
        if ($value !== null) {
            $value = parent::check($value);

            $length = mb_strlen($value, $this->encoding);

            if ($length > $this->field_length) {
                throw new LengthException('Length is greater than max length (' . $this->field_length . '): "' . $length . '"');
            }
        }

        return $value;
    }
}
