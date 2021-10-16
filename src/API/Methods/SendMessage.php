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

    public function __construct()
    {
        $this->allow_sending_without_reply = true;
        $this->disable_web_page_preview = true;
        $this->parse_mode = ParseStyle::HTML;
        $this->reply_markup = '';
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
     * @throws Exception|RequiredParameterException
     */
    public function getBody(): array
    {
        $body = [
            'chat_id' => $this->getChat(),
            'text' => $this->getText(),
        ];

        if (isset($this->parse_mode)) {
            $body['parse_mode'] = $this->getParseMode();
        } else {
            // TODO: get all entities from the message.
            $body['entities'] = $this->getEntities();
        }

        if (isset($this->reply_to_message_id)) {
            $body['reply_to_message_id'] = $this->reply_to_message_id;
        }

        return $body;
//            'disable_web_page_preview' => $this->disable_web_page_preview,
//            'disable_notification' => $this->getNotificationParameterValue(),
//            'allow_sending_without_reply' => $this->allow_sending_without_reply,
//            'reply_markup' => $this->reply_markup,
    }

    /**
     * @throws RequiredParameterException
     */
    private function getChat(): string
    {
        $this->verifyChatId();

        return $this->chat_id;
    }

    private function getDisableWebPagePreviewOptionValue(): bool
    {
        return $this->disable_web_page_preview;
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
     * @throws Exception
     */
    private function getText(): string
    {
        $this->verifyText();

        return $this->verifyTextLength();
    }

    /**
     * @throws RequiredParameterException
     */
    private function verifyChatId(): void
    {
        if (! isset($this->chat_id)) {
            throw RequiredParameterException::ChatIdParameterNotSet();
        }
    }

    /**
     * @throws Exception
     */
    private function verifyText()
    {
        if (! isset($this->text)) {
            throw RequiredParameterException::TextParameterNotSet();
        }
    }

    private function verifyTextLength(): string
    {
        if (strlen($this->text) > self::TEXT_MAX_LENGTH) {
            // TODO: implement method to isolate entities, then count & cut if necessary.
        }

        return $this->text;
    }

    /**
     * @param string $text
     * @return SendMessage
     */
    public function setText(string $text): SendMessage
    {
        $this->text = $text;

        return $this;
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