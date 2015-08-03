<?php

namespace Data\Field;

class TinyIntField extends IntField
{
    /**
     * @var int
     */
    const MIN_FIELD_VALUE_SIGNED = -128;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_SIGNED = 127;

    /**
     * @var int
     */
    const MIN_FIELD_VALUE_UNSIGNED = 0;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_UNSIGNED = 255;

    /**
     * @var int
     */
    const MIN_FIELD_VALUE_SERIAL = 1;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_SERIAL = 255;
}
