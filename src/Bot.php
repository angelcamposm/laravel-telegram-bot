<?php

namespace Acamposm\TelegramBot;

use Acamposm\TelegramBot\Enums\Dummy;
use Acamposm\TelegramBot\Exceptions\BotConfigurationException;

class Bot
{
    /**
     * Return the Telegram Bot API URL.
     *
     * @return string
     * @throws \Acamposm\TelegramBot\Exceptions\BotConfigurationException
     */
    public static function Api(): string
    {
//        if (config('telegram.bot.token') === Dummy::BOT_TOKEN) {
//            throw BotConfigurationException::TokenNotDefined();
//        }
//
//        return Telegram::Api().'bot'.config('telegram.bot.token').'/';
        return Telegram::Api().Dummy::BOT_TOKEN.'/';
    }

    /**
     * Return the Telegram BOT Name.
     *
     * @return string
     * @throws \Acamposm\TelegramBot\Exceptions\BotConfigurationException
     */
    public static function Name(): string
    {
        if (config('telegram.bot.name') === Dummy::BOT_NAME) {
            throw BotConfigurationException::NameNotDefined();
        }

        return config('telegram.bot.name');
    }
}