<?php

namespace Acamposm\TelegramBot\Facades;

use Illuminate\Support\Facades\Facade;

class TelegramFacade extends Facade
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
        return 'telegram';
    }
}