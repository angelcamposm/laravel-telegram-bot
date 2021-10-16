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

use Acamposm\TelegramBot\Exceptions\ValueException;

class InlineKeyboardMarkup
{
    /**
     * Array of button rows, each represented by an Array of InlineKeyboardButton objects.
     *
     * @var array
     */
    protected array $inline_keyboard;

    /**
     * Array of InlineKeyboardButton objects.
     *
     * @var array
     */
    protected array $button_rows;

    /**
     * Returns an instance of InlineKeyboardButton
     *
     * @return \Acamposm\TelegramBot\API\Types\InlineKeyboardMarkup
     */
    public static function create(): InlineKeyboardMarkup
    {
        return new static();
    }

    /**
     * Get the reply_markup object.
     *
     * @return string
     */
    public function get(): string
    {
        return self::encode([
            'inline_keyboard' => $this->getButtonRows(),
        ]);
    }

    /**
     * Add a button row to the keyboard markup.
     *
     * @param array $button_row
     *
     * @return InlineKeyboardMarkup
     * @throws \Acamposm\TelegramBot\Exceptions\ValueException
     */
    public function withRow(array $button_row): InlineKeyboardMarkup
    {
        if (empty($button_row)) {
            throw ValueException::EmptyButtonRow();
        }

        $this->button_rows[] = $button_row;

        return $this;
    }

    /**
     * Encodes an array of button rows.
     *
     * @param array $markup
     * @return string
     */
    private static function encode(array $markup): string
    {
        return json_encode($markup);
    }

    /**
     * Return button rows.
     *
     * @return array
     */
    private function getButtonRows(): array
    {
        return $this->button_rows;
    }
}