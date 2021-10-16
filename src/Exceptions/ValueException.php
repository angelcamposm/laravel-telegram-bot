<?php

namespace Acamposm\TelegramBot\Exceptions;

use Exception;
use Throwable;

class ValueException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function UnknownParseStyle(): ValueException
    {
        return new static('Unknown Parse mode style defined.');
    }
}