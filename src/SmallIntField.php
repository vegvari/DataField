<?php

namespace Data\Field;

class SmallIntField extends IntField
{
    /**
     * @var int
     */
    const MIN_FIELD_VALUE_SIGNED = -32768;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_SIGNED = 32767;

    /**
     * @var int
     */
    const MIN_FIELD_VALUE_UNSIGNED = 0;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_UNSIGNED = 65535;

    /**
     * @var int
     */
    const MIN_FIELD_VALUE_SERIAL = 1;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_SERIAL = 65535;
}
