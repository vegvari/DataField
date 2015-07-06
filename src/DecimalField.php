<?php

namespace Data\Field;

use Data\Type\FloatType;

use InvalidArgumentException;
use Data\Field\Exceptions\MinException;
use Data\Field\Exceptions\MaxException;

class DecimalField extends FloatType
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
     * @var bool
     */
    protected $nullable;

    /**
     * @var bool
     */
    protected $unsigned;

    /**
     * @param int   $precision 1-65
     * @param int   $scale     0-30, <= $precision
     * @param mixed $default
     * @param bool  $nullable
     * @param bool  $unsigned
     */
    public function __construct($precision, $scale, $default, $nullable, $unsigned)
    {
        if ($precision >= 1 && $precision <= 65) {
            $this->precision = (int) $precision;
        } else {
            throw new InvalidArgumentException('Precision must be between 1-65: "' . $precision . '"');
        }

        if ($scale === 0 || ($scale >= 1 && $scale <= 30)) {
            $this->scale = (int) $scale;
        } else {
            throw new InvalidArgumentException('Scale must be between 0-30: "' . $this->scale . '"');
        }

        if ($this->scale > $this->precision) {
            throw new InvalidArgumentException('Scale can\'t be greater than precision (precision: "' . $this->precision . '", scale: "' . $this->scale . '")');
        }

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
     * @param  int|null $precision 1-65
     * @param  int|null $scale     0-30, <= $precision
     * @param  mixed    $default
     * @return this
     */
    public static function signedNotNull($precision = 10, $scale = 2, $default = null)
    {
        return new static($precision, $scale, $default, false, false);
    }

    /**
     * Create signed, nullable
     *
     * @param  int|null $precision 1-65
     * @param  int|null $scale     0-30, <= $precision
     * @param  mixed    $default
     * @return this
     */
    public static function signedNullable($precision = 10, $scale = 2, $default = null)
    {
        return new static($precision, $scale, $default, true, false);
    }

    /**
     * Create unsigned, not null
     *
     * @param  int|null $precision 1-65
     * @param  int|null $scale     0-30, <= $precision
     * @param  mixed    $default
     * @return this
     */
    public static function unsignedNotNull($precision = 10, $scale = 2, $default = null)
    {
        return new static($precision, $scale, $default, false, true);
    }

    /**
     * Create unsigned, nullable
     *
     * @param  int   $precision 1-65
     * @param  int   $scale     0-30, <= $precision
     * @param  mixed $default
     * @return this
     */
    public static function unsignedNullable($precision = 10, $scale = 2, $default = null)
    {
        return new static($precision, $scale, $default, true, true);
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
     * The $value must be greater than this (not equal)
     *
     * @return float
     */
    public function getFieldMin()
    {
        if ($this->isUnsigned()) {
            return 0.0;
        } else {
            return (float) ('-1.0e' . ($this->precision - $this->scale));
        }
    }

    /**
     * The $value must be less than this (not equal)
     *
     * @return float
     */
    public function getFieldMax()
    {
        return (float) ('1.0e' . ($this->precision - $this->scale));
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

            if ( ! ($value > $this->getFieldMin())) {
                throw new MinException($this->getFieldMin(), $value);
            }

            if ( ! ($value < $this->getFieldMax())) {
                throw new MaxException($this->getFieldMax(), $value);
            }
        }

        return $value;
    }
}
