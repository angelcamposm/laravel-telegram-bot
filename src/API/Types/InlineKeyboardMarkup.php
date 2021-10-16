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
    protected array $button_row;

    /**
     * Get the reply_markup object.
     *
     * @return string
     */
    public function getReplyMarkup(): string
    {
        return self::encode([
            'inline_keyboard' => [

            ],
        ]);
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
}