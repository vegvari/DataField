<?php

namespace Data\Field;

use Data\Type\StringType;
use Data\Field\Exceptions\MaxLengthException;

abstract class StringField extends Field
{
    /**
     * @param string     $name
     * @param StringType $default
     * @param bool       $nullable
     */
    public function __construct($name, StringType $data, $nullable)
    {
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
     * Return the maximum length
     *
     * @return int
     */
    abstract public function getMaxLength();
}
