<?php

namespace Data\Field;

use Data\Type\IntType;

use InvalidArgumentException;
use Data\Field\Exceptions\MinValueException;
use Data\Field\Exceptions\MaxValueException;

class IntField extends NumberField
{
    /**
     * @var int
     */
    const MAX_FIELD_VALUE = 2147483647;

    /**
     * @var bool
     */
    protected $serial;

    /**
     * @var int
     */
    protected $min_value;

    /**
     * @var int
     */
    protected $max_value;

    /**
     * @param string  $name
     * @param IntType $data
     * @param bool    $nullable
     * @param bool    $unsigned
     * @param bool    $serial
     */
    public function __construct($name, IntType $data, $nullable, $unsigned, $serial)
    {
        if (! is_bool($serial)) {
            throw new InvalidArgumentException('Serial must be bool');
        }

        if ($serial === true && ! $data->isNull()) {
            throw new InvalidArgumentException('Serial field\'s default value must be null: "' . $this->getData() . '"');
        }

        if ($serial === true && $nullable === true) {
            throw new InvalidArgumentException('Serial field can\'t be nullable');
        }

        if ($serial === true && $unsigned === false) {
            throw new InvalidArgumentException('Serial field must be unsigned');
        }

        $this->serial = $serial;

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

        if ($this->getData()->lt($this->getMinValue())) {
            throw new MinValueException('Value less than the minimum value (' . $this->getMinValue() . ') of the field "' . $this->getName() . '": "' . $this->getData() . '"');
        }

        if ($this->getData()->gt($this->getMaxValue())) {
            throw new MaxValueException('Value greater than the maximum value (' . $this->getMaxValue() . ') of the field "' . $this->getName() . '": "' . $this->getData() . '"');
        }
    }

    /**
     * Minimum value
     *
     * @return int
     */
    public function getMinValue()
    {
        if ($this->min_value === null) {
            $min = ~$this->getMaxValue();

            if ($this->isUnsigned()) {
                $min = 0;
                if ($this->isSerial()) {
                    $min = 1;
                }
            }

            $this->min_value = $min;
        }

        return $this->min_value;
    }

    /**
     * Maximum value
     *
     * @return int
     */
    public function getMaxValue()
    {
        if ($this->max_value === null) {
            $max = static::MAX_FIELD_VALUE;

            if ($this->isUnsigned()) {
                $max = $max * 2 + 1;
            }

            if ($max > PHP_INT_MAX) {
                $max = PHP_INT_MAX;
            }

            $this->max_value = $max;
        }

        return $this->max_value;
    }

    /**
     * Is this field serial?
     *
     * @return bool
     */
    public function isSerial()
    {
        return $this->serial === true;
    }

    /**
     * Create signed, not null
     *
     * @param string $name
     * @param mixed  $default
     */
    public static function signedNotNull($name, $default = null)
    {
        return new static($name, new IntType($default), false, false, false);
    }

    /**
     * Create signed, nullable
     *
     * @param string $name
     * @param mixed  $default
     */
    public static function signedNullable($name, $default = null)
    {
        return new static($name, new IntType($default), true, false, false);
    }

    /**
     * Create unsigned, not null
     *
     * @param string $name
     * @param mixed  $default
     */
    public static function unsignedNotNull($name, $default = null)
    {
        return new static($name, new IntType($default), false, true, false);
    }

    /**
     * Create unsigned, nullable
     *
     * @param string $name
     * @param mixed  $default
     */
    public static function unsignedNullable($name, $default = null)
    {
        return new static($name, new IntType($default), true, true, false);
    }

    /**
     * Create serial
     *
     * @param string $name
     */
    public static function serial($name)
    {
        return new static($name, new IntType(), false, true, true);
    }
}
