<?php

namespace Data\Field;

use Data\Type\FloatType;

use InvalidArgumentException;
use Data\Field\Exceptions\MinValueException;
use Data\Field\Exceptions\MaxValueException;

class DecimalField extends NumberField
{
    /**
     * @var int 1-65
     */
    protected $precision;

    /**
     * @var int 0-30
     */
    protected $scale;

    /**
     * The value must be greater than this, not equal
     * @var float
     */
    protected $min_value;

    /**
     * The value must be less than this, not equal
     * @var float
     */
    protected $max_value;

    /**
     * @param string $name
     * @param int    $precision 1-65
     * @param int    $scale     0-30, <= $precision
     * @param mixed  $default
     * @param bool   $nullable
     * @param bool   $unsigned
     */
    public function __construct($name, FloatType $data, $nullable, $unsigned, $precision, $scale)
    {
        if (! is_int($precision) || $precision < 1 || $precision > 65) {
            throw new InvalidArgumentException('Precision must int be between 1-65: "' . $precision . '"');
        }

        if (! is_int($scale) || $scale < 0 || $scale > 30) {
            throw new InvalidArgumentException('Scale must be int between 0-30: "' . $scale . '"');
        }

        if ($scale > $precision) {
            throw new InvalidArgumentException('Scale is greater than precision: "' . $scale . ' > ' . $precision . '"');
        }
        $this->precision = $precision;
        $this->scale = $scale;

        parent::__construct($name, $data, $nullable, $unsigned);

        $this->getMinValue();
        $this->getMaxValue();
    }

    /**
     * Check the value of the data when it's changing
     */
    protected function check()
    {
        parent::check();

        if ($this->data()->lte($this->getMinValue())) {
            throw new MinValueException('Value is equal or less than minimum value (' . $this->getMaxValue() . ') of the field "' . $this->name() . '": "' . $this->data() . '"');
        }

        if ($this->data()->gte($this->getMaxValue())) {
            throw new MaxValueException('Value is equal or greater than maximum value (' . $this->getMaxValue() . ') of the field "' . $this->name() . '": "' . $this->data() . '"');
        }
    }

    /**
     * Minimum value
     *
     * @return float
     */
    public function getMinValue()
    {
        if ($this->min_value === null) {
            $this->min_value = 0.0;

            if (! $this->isUnsigned()) {
                $this->min_value = (float) ('-1.0e' . ($this->getPrecision() - $this->getScale()));
            }
        }

        return $this->min_value;
    }

    /**
     * Maximum value
     *
     * @return float
     */
    public function getMaxValue()
    {
        if ($this->max_value === null) {
            $this->max_value = (float) ('1.0e' . ($this->getPrecision() - $this->getScale()));
        }

        return $this->max_value;
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
     * Create signed, not null
     *
     * @param  string $name
     * @param  int    $precision 1-65
     * @param  int    $scale     0-30, <= $precision
     * @param  mixed  $default
     */
    public static function signedNotNull($name, $precision, $scale, $default = null)
    {
        return new static($name, new FloatType($default), false, false, $precision, $scale);
    }

    /**
     * Create signed, nullable
     *
     * @param  string $name
     * @param  int    $precision 1-65
     * @param  int    $scale     0-30, <= $precision
     * @param  mixed  $default
     */
    public static function signedNullable($name, $precision, $scale, $default = null)
    {
        return new static($name, new FloatType($default), true, false, $precision, $scale);
    }

    /**
     * Create unsigned, not null
     *
     * @param  string $name
     * @param  int    $precision 1-65
     * @param  int    $scale     0-30, <= $precision
     * @param  mixed  $default
     */
    public static function unsignedNotNull($name, $precision, $scale, $default = null)
    {
        return new static($name, new FloatType($default), false, true, $precision, $scale);
    }

    /**
     * Create unsigned, nullable
     *
     * @param  string $name
     * @param  int    $precision 1-65
     * @param  int    $scale     0-30, <= $precision
     * @param  mixed  $default
     */
    public static function unsignedNullable($precision, $scale, $default = null)
    {
        return new static($name, new FloatType($default), true, true, $precision, $scale);
    }
}
