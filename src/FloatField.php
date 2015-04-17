<?php

namespace Data\Field;

use Data\Type\Cast;
use Data\Type\FloatType;

class FloatField extends FloatType
{
    /**
     * Value can be null
     * @var bool
     */
    protected $nullable = false;

    /**
     * Value must be unsigned
     * @var boolean
     */
    protected $unsigned = false;

    /**
     * @param mixed $default
     * @param bool  $nullable
     * @param bool  $unsigned
     */
    public function __construct($default, $nullable = false, $unsigned = false)
    {
        $this->nullable = Cast::Bool($nullable);
        $this->unsigned = Cast::Bool($unsigned);

        parent::__construct($default);
    }

    /**
     * Signed factory
     *
     * @param  mixed $default
     * @return this
     */
    public static function signed($default = null)
    {
        $instance = new static($default);
        return $instance;
    }

    /**
     * Nullable factory
     *
     * @param  mixed $default
     * @return this
     */
    public static function nullable($default = null)
    {
        $instance = new static($default, true);
        return $instance;
    }

    /**
     * Unsigned factory
     *
     * @param  mixed $default
     * @return this
     */
    public static function unsigned($default = null)
    {
        $instance = new static($default, false, true);
        return $instance;
    }

    /**
     * Unsigned, nullable factory
     *
     * @param  mixed $default
     * @return this
     */
    public static function unsignedNullable($default = null)
    {
        $instance = new static($default, true, true);
        return $instance;
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
     * @param  mixed $value
     * @return int
     */
    protected function check($value)
    {
        $value = parent::check($value);

        if ($value !== null) {
            if ($this->unsigned === true) {
                if ($value < 0) {
                    throw new \InvalidArgumentException('Unsigned field must be positive or zero, "' . $value . '" given');
                }
            }
        }

        return $value;
    }
}
