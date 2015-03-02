<?php

namespace Data\Field;

abstract class Field
{
	protected $data;
	protected $nullable = false;

	public function __construct($default = null, $nullable = false)
	{
		$class = $this->data;
		$this->data = new $class($default);

		$this->nullable = \Data\Type\Bool::cast($nullable);

		$this->check();
	}

	public function __get($name)
	{
		return $this->$name;
	}

	public function set($value)
	{
		$this->data = $this->data->set($value);
		$this->check();
	}

	protected function check()
	{
	}
}
