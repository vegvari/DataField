<?php

namespace Data\Field;

class Float extends Number
{
	public static function nullable($default = null)
	{
		$class = get_called_class();
		$instance = new $class($default, true);
		return $instance;
	}

	public static function unsigned($default = null)
	{
		$class = get_called_class();
		$instance = new $class($default, true, true);
		return $instance;
	}

	public static function unsignedNullable($default = null)
	{
		$class = get_called_class();
		$instance = new $class($default, false, true);
		return $instance;
	}
}
