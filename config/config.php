<?php

return [

    /*
    | -------------------------------------------------------------------------
    | Telegram Default Bot
    | -------------------------------------------------------------------------
    |
    */
    'bot' => [

        'name' => env('TELEGRAM_BOT_NAME', \Acamposm\TelegramBot\Enums\Dummy::BOT_NAME),

        'token' => env('TELEGRAM_BOT_TOKEN', \Acamposm\TelegramBot\Enums\Dummy::BOT_TOKEN),
    ],
];