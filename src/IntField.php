<?php

namespace Data\Field;

use Data\Type\IntType;

use InvalidArgumentException;
use Data\Field\Exceptions\MinException;
use Data\Field\Exceptions\MaxException;
use Data\Field\Exceptions\UnsignedException;

class IntField extends IntType
{
    /**
     * @var bool
     */
    protected $nullable;

    /**
     * @var bool
     */
    protected $unsigned;

    /**
     * @var int
     */
    protected static $max_value = 2147483647;

    /**
     * @param mixed $default
     * @param bool  $nullable
     * @param bool  $unsigned
     */
    public function __construct($default, $nullable, $unsigned)
    {
        if ($nullable !== false && $nullable !== true) {
            throw new InvalidArgumentException('Nullable must be bool');
        }
        $this->nullable = $nullable;

        if ($unsigned !== false && $unsigned !== true) {
            throw new InvalidArgumentException('Unsigned must be bool');
        }
        $this->unsigned = $unsigned;

        if ($default !== null) {
            parent::__construct($default);
        }
    }

    /**
     * Create signed, not null
     *
     * @param  mixed $default
     * @return this
     */
    public static function signedNotNull($default = null)
    {
        return new static($default, false, false);
    }

    /**
     * Create signed, nullable
     *
     * @param  mixed $default
     * @return this
     */
    public static function signedNullable($default = null)
    {
        return new static($default, true, false);
    }

    /**
     * Create unsigned, not null
     *
     * @param  mixed $default
     * @return this
     */
    public static function unsignedNotNull($default = null)
    {
        return new static($default, false, true);
    }

    /**
     * Create unsigned, nullable
     *
     * @param  mixed $default
     * @return this
     */
    public static function unsignedNullable($default = null)
    {
        return new static($default, true, true);
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
     * Return the unsigned property
     *
     * @return bool
     */
    public function isUnsigned()
    {
        return $this->unsigned;
    }

    /**
     * Check the value
     *
     * @param  mixed    $value
     * @return int|null
     */
    protected function check($value)
    {
        if ($value !== null) {
            $value = parent::check($value);

            $min = ~static::$max_value;
            $max = static::$max_value;

            if ($this->unsigned === true) {
                $min = 0;
                $max = $max * 2 + 1;
            }

            if ($value < $min) {
                throw new MinException($min, $value);
            }

            if ($value > $max) {
                throw new MaxException($max, $value);
            }
        }

        return $value;
    }
}
