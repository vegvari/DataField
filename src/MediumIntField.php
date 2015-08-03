<?php

namespace Data\Field;

class MediumIntField extends IntField
{
    /**
     * @var int
     */
    const MIN_FIELD_VALUE_SIGNED = -8388608;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_SIGNED = 8388607;

    /**
     * @var int
     */
    const MIN_FIELD_VALUE_UNSIGNED = 0;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_UNSIGNED = 16777215;

    /**
     * @var int
     */
    const MIN_FIELD_VALUE_SERIAL = 1;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_SERIAL = 16777215;
}
