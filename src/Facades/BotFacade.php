<?php

namespace Acamposm\TelegramBot\Facades;

use Illuminate\Support\Facades\Facade;

class BotFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'bot';
    }
}