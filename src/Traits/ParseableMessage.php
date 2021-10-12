<?php

namespace Acamposm\TelegramBot\Traits;

trait ParseableMessage
{
    /**
     * Mode for parsing entities in the message text. See formatting options for more details.
     *
     * @required no
     * @var string
     */
    protected string $parse_mode;
}