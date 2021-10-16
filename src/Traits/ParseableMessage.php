<?php

namespace Acamposm\TelegramBot\Traits;

use Acamposm\TelegramBot\Enums\ParseStyle;
use Acamposm\TelegramBot\Exceptions\ValueException;

trait ParseableMessage
{
    /**
     * Mode for parsing entities in the message text.
     * See formatting options for more details.
     *
     * @required no
     * @var string
     */
    protected string $parse_mode;

    /**
     * Return the parse mode for the message.
     *
     * @return string
     *
     * @throws ValueException
     */
    private function getParseMode(): string
    {
        if (isset($this->parse_mode)) {
            $this->verifyParseMode();
        }

        return $this->parse_mode;
    }

    /**
     * @throws ValueException
     */
    private function verifyParseMode(): void
    {
        if (! in_array($this->parse_mode, ParseStyle::getValidStyles())) {
            throw ValueException::UnknownParseStyle();
        }
    }
}