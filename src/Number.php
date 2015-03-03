<?php

namespace Data\Field;

abstract class Number extends Field
{
    protected $data = '\Data\Type\Float';
    protected $unsigned = false;

    protected function __construct($default = null, $nullable = false, $unsigned = false)
    {
        $this->unsigned = \Data\Type\Bool::cast($unsigned);

        parent::__construct($default, $nullable);
    }

    protected function check()
    {
        if ($this->data->value === null) {
            return;
        }

        if ($this->unsigned === true && $this->data->value < 0) {
            throw new \InvalidArgumentException('Unsigned field can\'t be negative, "' . $this->data->value . '" given');
        }
    }
}
