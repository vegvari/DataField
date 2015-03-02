<?php

namespace Data\Field;

class Decimal extends Number
{
	protected $precision = 10;
	protected $scale = 2;

	public function __construct($precision = 10, $scale = 2, $default = null, $nullable = false, $unsigned = false)
	{
		parent::__construct($default, $nullable, $unsigned);

		$this->precision = \Data\Type\Int::cast($precision);
		$this->scale = \Data\Type\Int::cast($scale);

		if ($this->precision < 1 || $this->precision > 65) {
			throw new \InvalidArgumentException('Precision must be between 1-65, "' . $this->precision . '" given');
		}

		if ($this->scale < 0 || $this->scale > 30) {
			throw new \InvalidArgumentException('Scale must be between 0-30, "' . $this->scale . '" given');
		}

		if ($this->scale > $this->precision) {
			throw new \InvalidArgumentException('Scale can\'t be larger than precision (precision: "' . $this->precision . '", scale: "' . $this->scale . '")');
		}
	}

	public static function nullable($precision, $scale, $default = null)
	{
		$class = get_called_class();
		$instance = new $class($precision, $scale, $default, true);
		return $instance;
	}

	public static function unsigned($precision, $scale, $default = null)
	{
		$class = get_called_class();
		$instance = new $class($precision, $scale, $default, true, true);
		return $instance;
	}

	public static function unsignedNullable($precision, $scale, $default = null)
	{
		$class = get_called_class();
		$instance = new $class($precision, $scale, $default, false, true);
		return $instance;
	}

	protected function check()
	{
		parent::check();

		if ($this->data->value !== null && $this->unsigned === false) {
			$min = (float) ('-1.0e' . ($this->precision - $this->scale));

			if ($this->data->value <= $min) {
				throw new \InvalidArgumentException('Min value is ' . $min . ', "' . $this->data->value . '" given');
			}
		}

		$max = (float) ('1.0e' . ($this->precision - $this->scale));
		if ($this->data->value >= $max) {
			throw new \InvalidArgumentException('Max value is ' . $max . ', "' . $this->data->value . '" given');
		}

		if ($this->data->value !== null) {
			$this->data = $this->data->set(round($this->data->value, $this->scale));
		}

		// var_dump($min, $max);
		// exit;
	}
}
