<?php

namespace Acamposm\TelegramBot\API\Methods;

use Acamposm\TelegramBot\Contracts\RequestMethod;
use Acamposm\TelegramBot\Traits\NotifiableMessage;
use Acamposm\TelegramBot\Traits\ParseableMessage;
use Acamposm\TelegramBot\Traits\ReplyableMessage;

class SendDocument implements RequestMethod
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
     * File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended),
     * pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using
     * multipart/form-data.
     *
     * @required yes
     * @var string
     */
    protected string $document;

    /**
     * Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side.
     * The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should
     * not exceed 320.
     * Ignored if the file is not uploaded using multipart/form-data.
     * Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>”
     * if the thumbnail was uploaded using multipart/form-data under <file_attach_name>.
     *
     * @required no
     * @var string
     */
    protected string $thumb;

    /**
     * Document caption (may also be used when resending documents by file_id), 0-1024 characters after entities
     * parsing.
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
     * Disables automatic server-side content type detection for files uploaded using multipart/form-data.
     *
     * @required no
     * @var bool
     */
    protected bool $disable_content_type_detection;
}