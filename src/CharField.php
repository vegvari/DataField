<?php

namespace Data\Field;

use Data\Type\StringType;
use Data\Field\Exceptions\InvalidLengthArgumentException;

class CharField extends StringType
{
    /**
     * @var int
     */
    const MAX_FIELD_LENGTH = 255;

    /**
     * @param string $name
     * @param mixed  $default
     * @param bool   $nullable
     * @param int    $length
     */
    public function __construct($name, StringType $data, $nullable, $length)
    {
        if (! is_int($length) || $length < 1) {
            throw new InvalidLengthArgumentException('Length must be positive int: "' . $length . '"');
        }

        if ($length > self::MAX_FIELD_LENGTH) {
            throw new InvalidLengthArgumentException('Length is greater than max length (' . self::MAX_FIELD_LENGTH . '): "' . $length . '"');
        }

        $this->field_length = (int) $length;

        parent::__construct($name, $data, $nullable);
    }
}
