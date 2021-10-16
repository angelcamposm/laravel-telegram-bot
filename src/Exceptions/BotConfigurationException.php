<?php

namespace Acamposm\TelegramBot\Exceptions;

use Exception;
use Throwable;

class BotConfigurationException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function BotNameNotDefined(): BotConfigurationException
    {
        return new static('Telegram Bot name not defined in .env file');
    }

    public static function BotTokenNotDefined(): BotConfigurationException
    {
        return new static('Telegram Bot token not defined in .env file');
    }
}