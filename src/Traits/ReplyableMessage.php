<?php

/*
 * This file is part of acamposm\laravel-telegram-bot package.
 *
 * Copyright (c) Angel Campos Muñoz <angel.campos.m@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acamposm\TelegramBot\Traits;

use Acamposm\TelegramBot\Contracts\RequestMethod;

trait ReplyableMessage
{
    /**
     * If the message is a reply, ID of the original message.
     *
     * @required no
     * @var string|int
     */
    protected string|int $reply_to_message_id;

    /**
     * Pass True, if the message should be sent even if the specified replied-to message is not found.
     *
     * @required no
     * @var bool
     */
    protected bool $allow_sending_without_reply;

    /**
     * Additional interface options.
     * A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove
     * reply keyboard or to force a reply from the user.
     * Types: InlineKeyboardMarkup or ReplyKeyboardMarkup or ReplyKeyboardRemove or ForceReply.
     *
     * @required no
     * @var string
     */
    protected string $reply_markup;

    /**
     * Return the value or parameter allow_sending_without_reply
     *
     * @return bool
     */
    private function getSendingWithoutReplyParameterValue(): bool
    {
        return $this->allow_sending_without_reply ?? false;
    }

    /**
     *
     *
     * @param string $reply_markup
     * @return \Acamposm\TelegramBot\Contracts\RequestMethod
     */
    public function setReplyMarkup(string $reply_markup): RequestMethod
    {
        $this->reply_markup = $reply_markup;

        return $this;
    }
}