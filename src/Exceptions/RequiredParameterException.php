<?php

/*
 * This file is part of acamposm\laravel-telegram-bot package.
 *
 * Copyright (c) Angel Campos Muñoz <angel.campos.m@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acamposm\TelegramBot\Exceptions;

use Exception;
use Throwable;

class RequiredParameterException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function ChatIdParameterNotSet(): RequiredParameterException
    {
        return new static('Chat ID parameter is required.');
    }

    public static function TextParameterNotSet(): RequiredParameterException
    {
        return new static('Text parameter is required.');
    }
}