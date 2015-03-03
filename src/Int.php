<?php

namespace Data\Field;

class Int extends Float
{
    protected $data = '\Data\Type\Int';
    protected $serial = false;

    protected function __construct($default = null, $nullable = false, $unsigned = false, $serial = false)
    {
        parent::__construct($default, $nullable, $unsigned);

        $this->serial = \Data\Type\Bool::cast($serial);

        if ($this->nullable === true && $this->serial === true) {
            throw new \InvalidArgumentException('Serial can\'t be nullable');
        }

        if ($this->unsigned === false && $this->serial === true) {
            throw new \InvalidArgumentException('Serial must be unsigned');
        }
    }

    protected function check()
    {
        if ($this->data->value !== null && $this->serial === true) {
            if ($this->data->value < 1) {
                throw new \InvalidArgumentException('Serial must be larger than 0, "' . $this->data->value . '" given');
            }
        }

        parent::check();
    }

    public static function serial()
    {
        $class = get_called_class();
        $instance = new $class(null, false, true, true);
        return $instance;
    }
}
