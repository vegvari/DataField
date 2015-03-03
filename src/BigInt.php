<?php

namespace Data\Field;

class BigInt extends Int
{
    // @fixme FILTER_VALIDATE_INT can't handle big numbers
    protected static $max = 2147483647;
}
