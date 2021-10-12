<?php

namespace Acamposm\TelegramBot\Exceptions;

use Exception;

class BotConfigurationException extends Exception
{
    /**
     * Throw exception when bot name is not defined.
     *
     * @return \Acamposm\TelegramBot\Exceptions\BotConfigurationException
     */
    public static function NameNotDefined(): BotConfigurationException
    {
        return new static('Telegram Bot name not defined in .env file');
    }

    /**
     * Throw exception when bot token is not defined.
     *
     * @return \Acamposm\TelegramBot\Exceptions\BotConfigurationException
     */
    public static function TokenNotDefined(): BotConfigurationException
    {
        return new static('Telegram Bot token not defined in .env file');
    }
}