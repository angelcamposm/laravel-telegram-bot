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

class ValueException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function EmptyButtonRow()
    {
        return new static('A button row must not be empty');
    }

    public static function NotValidUrl(): ValueException
    {
        return new static('Not valid URL provided');
    }

    public static function UnknownParseStyle(): ValueException
    {
        return new static('Unknown Parse mode style defined.');
    }
}