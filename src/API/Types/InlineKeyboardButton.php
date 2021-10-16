<?php

/*
 * This file is part of acamposm\laravel-telegram-bot package.
 *
 * Copyright (c) Angel Campos Muñoz <angel.campos.m@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acamposm\TelegramBot\API\Types;

use Acamposm\TelegramBot\Exceptions\RequiredParameterException;
use Acamposm\TelegramBot\Exceptions\ValueException;

class InlineKeyboardButton
{
    /**
     * Label text on the button.
     *
     * @required yes
     * @var string
     */
    protected string $text;

    /**
     * HTTP or tg:// url to be opened when button is pressed
     *
     * @required no
     * @var string
     */
    protected string $url;

    /**
     * An HTTP URL used to automatically authorize the user.
     * Can be used as a replacement for the Telegram Login Widget.
     *
     * @required no
     * @var string
     */
    protected string $login_url;

    /**
     * Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes.
     *
     * @required no
     * @var string
     */
    protected string $callback_data;

    /**
     * If set, pressing the button will prompt the user to select one of their chats, open that
     * chat and insert the bot's username and the specified inline query in the input field.
     * Can be empty, in which case just the bot's username will be inserted.
     *
     * @required no
     * @var string
     */
    protected string $switch_inline_query;

    /**
     * If set, pressing the button will insert the bot's username and the specified inline query
     * in the current chat's input field.
     * Can be empty, in which case only the bot's username will be inserted.
     *
     * @required no
     * @var string
     */
    protected string $switch_inline_query_current_chat;

    /**
     * Description of the game that will be launched when the user presses the button.
     * NOTE: This type of button must always be the first button in the first row.
     *
     * @required no
     * @var string
     */
    protected string $callback_game;

    /**
     * Specify True, to send a Pay button.
     * NOTE: This type of button must always be the first button in the first row.
     *
     * @required no
     * @var bool
     */
    protected bool $pay;


    /**
     * Returns an instance of InlineKeyboardButton
     *
     * @return \Acamposm\TelegramBot\API\Types\InlineKeyboardButton
     */
    public static function Create(): InlineKeyboardButton
    {
        return new static();
    }

    /**
     * Set the text of the button.
     *
     * @param string $text
     *
     * @return InlineKeyboardButton
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     */
    public function withText(string $text): InlineKeyboardButton
    {
        if (empty($text)) {
            throw RequiredParameterException::TextParameterNotSet();
        }

        $this->text = $text;

        return $this;
    }

    /**
     * Set the url of the link of the button.
     *
     * @param string $url
     *
     * @return InlineKeyboardButton
     * @throws \Acamposm\TelegramBot\Exceptions\ValueException
     */
    public function withUrl(string $url): InlineKeyboardButton
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw ValueException::NotValidUrl();
        }

        $this->url = $url;

        return $this;
    }

    /**
     * Get a button object.
     *
     * @return array
     */
    public function get(): array
    {
        $button = [];

        if (isset($this->text)) {
            $button['text'] = $this->text;
        }

        if (isset($this->url)) {
            $button['url'] = $this->url;
        }

        return $button;
    }
}