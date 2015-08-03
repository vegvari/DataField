<?php

namespace Data\Field;

class BigIntField extends IntField
{
	/**
     * @var int
     */
    const MIN_FIELD_VALUE_SIGNED = -9223372036854775808;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_SIGNED = 9223372036854775807;

    /**
     * @var int
     */
    const MIN_FIELD_VALUE_UNSIGNED = 0;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_UNSIGNED = 9223372036854775807;

    /**
     * @var int
     */
    const MIN_FIELD_VALUE_SERIAL = 1;

    /**
     * @var int
     */
    const MAX_FIELD_VALUE_SERIAL = 9223372036854775807;
}
