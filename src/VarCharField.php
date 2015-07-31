<?php

namespace Data\Field;

use Data\Type\StringType;

use InvalidArgumentException;

class VarCharField extends CharField
{
    /**
     * @var int
     */
    const MAX_FIELD_LENGTH = 65535;
}
