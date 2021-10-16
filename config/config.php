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

    /*
    | -------------------------------------------------------------------------
    | Telegram Options
    | -------------------------------------------------------------------------
    |
    */
    'options' => [

        'default' => [

            /*
             * The message should be sent even if the specified replied-to message is not found.
             */
            'allow_sending_without_reply' => env('TELEGRAM_SEND_WITHOUT_REPLY', true),

            /*
             * Sends the message silently.
             * Users will receive a notification with no sound.
             */
            'disable_notification' => env('TELEGRAM_DISABLE_NOTIFICATION', true),

            /*
             * Disables link previews for links in this message.
             */
            'disable_web_page_preview' => env('TELEGRAM_DISABLE_PREVIEW', false),

            /*
             * Mode for parsing entities in the message text.
             */
            'parse_mode' => env('TELEGRAM_PARSE_STYLE', \Acamposm\TelegramBot\Enums\ParseStyle::HTML),
        ],
    ],
];