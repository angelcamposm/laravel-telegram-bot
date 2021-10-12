<?php

namespace Acamposm\TelegramBot\API\Methods;

use Acamposm\TelegramBot\Contracts\RequestMethod;
use Acamposm\TelegramBot\Traits\NotifiableMessage;
use Acamposm\TelegramBot\Traits\ParseableMessage;
use Acamposm\TelegramBot\Traits\ReplyableMessage;

class SendMessage implements RequestMethod
{
    use NotifiableMessage,
        ParseableMessage,
        ReplyableMessage;

    /**
     * Identifier for the target chat or username of the target channel (in the format @channelusername).
     *
     * @required yes
     * @var string
     */
    protected string $chat_id;

    /**
     * Text of the message to be sent, 1-4096 characters after entities parsing.
     *
     * @required yes
     * @var string
     */
    protected string $text;

    /**
     * A JSON-serialized list of special entities that appear in message text, which can be specified
     * instead of parse_mode.
     *
     * @required no
     * @var string
     */
    protected string $entities;

    /**
     * Disables link previews for links in this message.
     *
     * @required no
     * @var bool
     */
    protected bool $disable_web_page_preview;
}