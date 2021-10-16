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
use Acamposm\TelegramBot\Traits\NotifiableMessage;
use Acamposm\TelegramBot\Traits\ParseableMessage;
use Acamposm\TelegramBot\Traits\ReplyableMessage;

class SendPhoto implements RequestMethod
{
    use NotifiableMessage,
        ParseableMessage,
        ReplyableMessage;

    /**
     * Identifier for the target chat or username of the target channel (in the format @channelusername).
     *
     * @required yes
     * @var string
     */
    protected string $chat_id;

    /**
     * Photo to send.
     * Pass a file_id as String to send a photo that exists on the Telegram servers (recommended),
     * pass an HTTP URL as a String for Telegram to get a photo from the Internet, or upload a new photo using
     * multipart/form-data.
     * The photo must be at most 10 MB in size. The photo's width and height must not exceed 10000 in total.
     * Width and height ratio must be at most 20.
     * More info on Sending Files »
     *
     * @required yes
     * @var string
     */
    protected string $photo;

    /**
     * Photo caption (may also be used when resending photos by file_id), 0-1024 characters after entities parsing
     *
     * @required no
     * @var string
     */
    protected string $caption;

    /**
     * A JSON-serialized list of special entities that appear in the caption, which can be specified instead
     * of parse_mode.
     *
     * @required no
     * @var string
     */
    protected string $caption_entities;

    /**
     * Returns the body for the request.
     *
     * @return array
     */
    public function getBody(): array
    {
        // TODO: Implement getBody() method.
        return [];
    }
}