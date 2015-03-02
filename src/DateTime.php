<?php

namespace Data\Field;

class DateTime extends Field
{
	protected $data = '\Data\Type\DateTime';

	public static function nullable($default = null)
	{
		$class = get_called_class();
		$instance = new $class($default, true);
		return $instance;
	}
}
