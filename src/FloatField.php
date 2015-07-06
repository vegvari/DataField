<?php

namespace Data\Field;

use Data\Type\FloatType;

use InvalidArgumentException;
use Data\Field\Exceptions\MinException;
use Data\Field\Exceptions\MaxException;
use Data\Field\Exceptions\UnsignedException;

class FloatField extends FloatType
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
     * @param  mixed      $value
     * @return float|null
     */
    protected function check($value)
    {
        if ($value !== null) {
            $value = parent::check($value);

            if ($this->unsigned === true) {
                if ($value < 0) {
                    throw new MinException(0, $value);
                }
            }
        }

        return $value;
    }
}
