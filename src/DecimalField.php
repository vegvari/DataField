<?php

namespace Data\Field;

use Data\Type\Cast;
use Data\Type\FloatType;

class DecimalField extends FloatType
{
    /**
     * 1-65
     * @var int
     */
    protected $precision = 10;

    /**
     * 0-30
     * @var int
     */
    protected $scale = 2;

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
     * @param int   $precision 1-65
     * @param int   $scale     0-30
     * @param mixed $default
     * @param bool  $nullable
     * @param bool  $unsigned
     */
    public function __construct($precision = 10, $scale = 2, $default = null, $nullable = false, $unsigned = false)
    {
        $this->precision = Cast::Int($precision);
        $this->scale     = Cast::Int($scale);
        $this->nullable  = Cast::Bool($nullable);
        $this->unsigned  = Cast::Bool($unsigned);

        if ($this->precision < 1 || $this->precision > 65) {
            throw new \InvalidArgumentException('Precision must be between 1-65, "' . $this->precision . '" given');
        }

        if ($this->scale < 0 || $this->scale > 30) {
            throw new \InvalidArgumentException('Scale must be between 0-30, "' . $this->scale . '" given');
        }

        if ($this->scale > $this->precision) {
            throw new \InvalidArgumentException('Scale can\'t be larger than precision (precision: "' . $this->precision . '", scale: "' . $this->scale . '")');
        }

        $this->set($default);
    }

    /**
     * Signed factory
     *
     * @param  int   $precision 1-65
     * @param  int   $scale     0-30
     * @param  mixed $default
     * @return this
     */
    public static function signed($precision, $scale, $default = null)
    {
        $instance = new static($precision, $scale, $default);
        return $instance;
    }

    /**
     * Unsigned factory
     *
     * @param  int   $precision 1-65
     * @param  int   $scale     0-30
     * @param  mixed $default
     * @return this
     */
    public static function unsigned($precision, $scale, $default = null)
    {
        $instance = new static($precision, $scale, $default, false, true);
        return $instance;
    }

    /**
     * Nullable factory
     *
     * @param  int   $precision 1-65
     * @param  int   $scale     0-30
     * @param  mixed $default
     * @return this
     */
    public static function nullable($precision, $scale, $default = null)
    {
        $instance = new static($precision, $scale, $default, true);
        return $instance;
    }

    /**
     * Unsigned nullable factory
     *
     * @param  int   $precision 1-65
     * @param  int   $scale     0-30
     * @param  mixed $default
     * @return this
     */
    public static function unsignedNullable($precision, $scale, $default = null)
    {
        $instance = new static($precision, $scale, $default, true, true);
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
     * Return the precision property
     *
     * @return int
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * Return the scale property
     *
     * @return int
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Check the value
     *
     * @param  mixed $value
     * @return float
     */
    protected function check($value)
    {
        $value = parent::check($value);

        if ($value !== null) {
            if ($this->unsigned === true && $value < 0) {
                throw new \InvalidArgumentException('Unsigned field must be positive or zero, "' . $value . '" given');
            }

            $min = (float) ('-1.0e' . ($this->precision - $this->scale));
            if ( ! ($value > $min)) {
                throw new \InvalidArgumentException('Value must be greater than ' . $min . ', "' . $value . '" given');
            }

            $max = (float) ('1.0e' . ($this->precision - $this->scale));
            if ( ! ($value < $max)) {
                throw new \InvalidArgumentException('Value must be lower than ' . $max . ', "' . $value . '" given');
            }
        }

        return $value;
    }
}
