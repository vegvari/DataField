<?php

namespace Data\Field;

class BigIntField extends IntField
{
    /**
     * @var int
     */
    const MIN_FIELD_VALUE_SIGNED = ~PHP_INT_MAX;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_SIGNED = PHP_INT_MAX;

    /**
     * @var int
     */
    const MIN_FIELD_VALUE_UNSIGNED = 0;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_UNSIGNED = PHP_INT_MAX;

    /**
     * @var int
     */
    const MIN_FIELD_VALUE_SERIAL = 1;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_SERIAL = PHP_INT_MAX;
}
