<?php

namespace Data\Field;

use Data\Type\StringType;
use Data\Field\Exceptions\MaxLengthException;

abstract class StringField extends Field
{
    /**
     * @var int
     */
    protected $max_length;

    /**
     * @param string $name
     * @param mixed  $default
     * @param bool   $nullable
     */
    public function __construct($name, StringType $data, $nullable)
    {
        $this->max_length = static::MAX_FIELD_LENGTH;
        parent::__construct($name, $data, $nullable);
    }

    /**
     * Check the value of the data when it's changing
     */
    public function check()
    {
        if ($this->getData()->length() > $this->getMaxLength()) {
            throw new MaxLengthException('Value is longer than the maximum length (' . $this->getMaxLength() . ') of the field "' . $this->getName() . '": "' . $this->getData()->length() . '"');
        }
    }

    /**
     * Return the max_length property
     *
     * @return int
     */
    public function getMaxLength()
    {
        return $this->max_length;
    }
}
