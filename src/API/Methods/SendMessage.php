<?php

/*
 * This file is part of acamposm\laravel-telegram-bot package.
 *
 * Copyright (c) Angel Campos Muñoz <angel.campos.m@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acamposm\TelegramBot\API\Methods;

use Acamposm\TelegramBot\Contracts\RequestMethod;
use Acamposm\TelegramBot\Enums\ParseStyle;
use Acamposm\TelegramBot\Exceptions\RequiredParameterException;
use Acamposm\TelegramBot\Exceptions\ValueException;
use Acamposm\TelegramBot\Traits\NotifiableMessage;
use Acamposm\TelegramBot\Traits\ParseableMessage;
use Acamposm\TelegramBot\Traits\ReplyableMessage;
use Exception;

class SendMessage implements RequestMethod
{
    use NotifiableMessage,
        ParseableMessage,
        ReplyableMessage;

    public const TEXT_MAX_LENGTH = 4096;

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

    /**
     * SendMessage constructor.
     *
     * @param string $chat_id
     */
    public function __construct(string $chat_id = '')
    {
        $this->chat_id = $chat_id;
        $this->initialize();
    }

    /**
     * Return a new SendMessage instance.
     *
     * @param string $chat_id
     *
     * @return static
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     */
    public static function toChat(string $chat_id = '')
    {
        if (strLen($chat_id) === 0) {
            throw RequiredParameterException::ChatIdParameterNotSet();
        }

        return new static($chat_id);
    }

    /**
     * Set the Chat ID of the target chat.
     *
     * @param string $chat_id
     *
     * @return $this
     */
    public function setChatId(string $chat_id): SendMessage
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * Returns the body for the request.
     *
     * @return array
     * @throws Exception
     */
    public function getBody(): array
    {
        $body = [];

        if (isset($this->chat_id)) {
            $body['chat_id'] = $this->chat_id;
        } else {
            throw RequiredParameterException::ChatIdParameterNotSet();
        }

        if (isset($this->text)) {
            $body['text'] = $this->text;
        } else {
            throw RequiredParameterException::TextParameterNotSet();
        }

        if (isset($this->allow_sending_without_reply)) {
            $body['allow_sending_without_reply'] = $this->allow_sending_without_reply;
        }

        if (isset($this->disable_notification)) {
            $body['disable_notification'] = $this->disable_notification;
        }

        if (isset($this->disable_web_page_preview)) {
            $body['disable_web_page_preview'] = $this->disable_web_page_preview;
        }

        if (isset($this->parse_mode)) {
            $body['parse_mode'] = $this->getParseMode();
        } else {
            // TODO: get all entities from the message.
            $body['entities'] = $this->getEntities();
        }

        if (isset($this->reply_markup)) {
            $body['reply_markup'] = $this->reply_markup;
        }

        if (isset($this->reply_to_message_id)) {
            $body['reply_to_message_id'] = $this->reply_to_message_id;
        }

        return $body;
    }

    /**
     * Return a JSON string with all entities.
     *
     * @return string
     */
    private function getEntities(): string
    {
        if (! isset($this->entities)) {
            return '';
        }

        // TODO: Retrieve all entities from the text parameter.

        return $this->entities;
    }

    /**
     * Set the text of the Telegram Message.
     *
     * @param string $text
     * @return SendMessage
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     */
    public function withText(string $text): SendMessage
    {
        if (empty($text) || $text === '') {
            throw RequiredParameterException::TextParameterNotSet();
        }

        if (strlen($text) > self::TEXT_MAX_LENGTH) {
            // TODO: implement method to isolate entities, then count & cut if necessary.
        }

        $this->text = $text;

        return $this;
    }

    /**
     * Set default parameter values.
     */
    private function initialize(): void
    {
        $this->allow_sending_without_reply = true;
        $this->disable_web_page_preview = true;
        $this->parse_mode = ParseStyle::HTML;
    }

    /**
     * @param string $entities
     * @return SendMessage
     */
    public function setEntities(string $entities): SendMessage
    {
        $this->entities = $entities;

        return $this;
    }
}