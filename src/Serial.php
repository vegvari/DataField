<?php

namespace Data\Field;

class Serial extends Int
{
	protected $nullable = false;
	protected $unsigned = true;
	protected $primary = true;
	protected $serial = true;

	public function __construct($default = null, $nullable = false, $unsigned = true)
	{
		parent::__construct($default, $nullable, $unsigned);

		if ($this->nullable === true) {
			throw new \InvalidArgumentException('Serial can\'t be nullable');
		}

		if ($this->unsigned === false) {
			throw new \InvalidArgumentException('Serial must be unsigned');
		}
	}

	protected function check()
	{
		parent::check();

		if ($this->data->value !== null) {
			if ($this->data->value < 1) {
				throw new \InvalidArgumentException('Serial must be larger than 0, "' . $this->data->value . '" given');
			}
		}
	}
}
