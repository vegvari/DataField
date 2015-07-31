<?php

namespace Data\Field;

use Data\Type\Number;

use InvalidArgumentException;
use Data\Field\Exceptions\MinValueException;

abstract class NumberField extends Field
{
    /**
     * @var bool
     */
    protected $unsigned;

    /**
     * @param string $name
     * @param Number $data
     * @param bool   $nullable
     * @param bool   $unsigned
     */
    public function __construct($name, Number $data, $nullable, $unsigned)
    {
        if (! is_bool($unsigned)) {
            throw new InvalidArgumentException('Unsigned must be bool');
        }

        $this->unsigned = $unsigned;

        parent::__construct($name, $data, $nullable);
    }

    /**
     * Check the value of the data when it's changing
     */
    protected function check()
    {
        if ($this->isUnsigned() && $this->getData()->lt(0)) {
            throw new MinValueException('Unsigned field "' . $this->getName() . '" can\'t be less than zero');
        }
    }

    /**
     * Is this field unsigned?
     *
     * @return bool
     */
    public function isUnsigned()
    {
        return $this->unsigned === true;
    }
}
