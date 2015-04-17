<?php

namespace Data\Field;

class CharField extends VarCharField
{
    /**
     * Maximum length
     * @var int
     */
    protected static $maxLength = 255;
}
