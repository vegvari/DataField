<?php

namespace Data\Field;

use Data\Type\Cast;
use Data\Type\StringType;

class VarCharField extends StringType
{
    /**
     * Maximum length
     * @var int
     */
    protected static $maxLength = 65535;

    /**
     * Actual maximum length
     * @var int
     */
    protected $length = 255;

    /**
     * Value can be null
     * @var bool
     */
    protected $nullable = false;

    public function __construct($length = 255, $default = null, $nullable = false)
    {
        try {
            $this->length = Cast::pInt($length);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('Length must be 0 or positive integer, ' . $this->length . ' given');
        }

        if ($this->length > static::$maxLength) {
            throw new \InvalidArgumentException('Length (' . $this->length . ') is larger than maxLength (' . static::$maxLength . ')');
        }

        parent::__construct($default);
    }

    protected function check($value)
    {
        $value = parent::check($value);

        if ($this->length < $this->length()) {
            throw new \LengthException('Length of the string (' . $this->data->length . ') is larger than length of the field (' . $this->length . ')');
        }

        return $value;
    }
}
