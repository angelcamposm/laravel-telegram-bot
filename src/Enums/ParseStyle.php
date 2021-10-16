<?php

/*
 * This file is part of acamposm\laravel-telegram-bot package.
 *
 * Copyright (c) Angel Campos Muñoz <angel.campos.m@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acamposm\TelegramBot\Enums;

class ParseStyle
{
    public const HTML = 'HTML';
    public const MARKDOWN = 'Markdown';
    public const MARKDOWN_V2 = 'MarkdownV2';

    /**
     * Return an array with all Parse Modes.
     *
     * @return string[]
     */
    public static function getValidStyles(): array
    {
        return [
            self::HTML,
            self::MARKDOWN,
            self::MARKDOWN_V2,
        ];
    }
}