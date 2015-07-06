<?php

namespace Data\Field\Exceptions;

use InvalidArgumentException;

class MinException extends InvalidArgumentException
{
	public function __construct($min, $value, $code = 0, Exception $previous = null)
	{
		$this->message = 'Value is less than ' . $min . ': "' . $value . '"';
		parent::__construct($this->message, $code, $previous);
	}
}
