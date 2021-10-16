<?php

namespace Acamposm\TelegramBot\Traits;

use Acamposm\TelegramBot\Contracts\RequestMethod;
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
     * Mode for parsing entities in the message text.
     *
     * @param string $parse_mode
     *
     * @return \Acamposm\TelegramBot\Contracts\RequestMethod
     * @throws \Acamposm\TelegramBot\Exceptions\ValueException
     */
    public function setParseMode(string $parse_mode): RequestMethod
    {
        self::verifyParseMode($parse_mode);

        $this->parse_mode = $parse_mode;

        return $this;
    }

    /**
     * Return the parse mode for the message.
     *
     * @return string
     */
    private function getParseMode(): string
    {
        return $this->parse_mode;
    }

    /**
     * Verifies if parse_mode is a valid mode of parsing messages.
     *
     * @throws ValueException
     */
    private static function verifyParseMode(string $parse_mode): void
    {
        if (! in_array($parse_mode, ParseStyle::getValidStyles())) {
            throw ValueException::UnknownParseStyle();
        }
    }
}