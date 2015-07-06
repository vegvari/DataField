<?php

namespace Data\Field\Exceptions;

use InvalidArgumentException;

class MaxException extends InvalidArgumentException
{
	public function __construct($max, $value, $code = 0, Exception $previous = null)
	{
		$this->message = 'Value is greater than ' . $max . ': "' . $value . '"';
		parent::__construct($this->message, $code, $previous);
	}
}
