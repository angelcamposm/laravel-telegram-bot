<?php

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