<?php

declare(strict_types=1);

/*
 * This file is part of acamposm\laravel-telegram-bot package.
 *
 * Copyright (c) Angel Campos Muñoz <angel.campos.m@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acamposm\TelegramBot\Tests\Unit;

use Acamposm\TelegramBot\API\Methods\SendMessage;
use Acamposm\TelegramBot\Enums\Dummy;
use Acamposm\TelegramBot\Enums\ParseStyle;
use Acamposm\TelegramBot\Exceptions\RequiredParameterException;
use Acamposm\TelegramBot\Exceptions\ValueException;
use PHPUnit\Framework\TestCase;

class CreateSendMessageTest extends TestCase
{
    public function test_it_can_create_a_new_instance()
    {
        $this->assertInstanceOf(SendMessage::class, new SendMessage());
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     * @throws \Exception
     */
    public function test_it_throw_exception_if_no_chat_id_is_assigned()
    {
        $this->expectException(RequiredParameterException::class);

        SendMessage::toChat('')->withText(Dummy::CHAT_TEXT)->getBody();
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     */
    public function test_i_can_assign_a_chat_id()
    {
        $this->assertEquals(
            Dummy::CHAT_ID,
            SendMessage::toChat(Dummy::CHAT_ID)->withText(Dummy::CHAT_TEXT)->getBody()['chat_id']
        );
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     */
    public function test_it_throw_exception_if_no_text_is_assigned()
    {
        $this->expectException(RequiredParameterException::class);

        SendMessage::toChat(Dummy::CHAT_ID)->getBody();
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     */
    public function test_i_can_assign_a_text()
    {
        $this->assertEquals(
            Dummy::CHAT_TEXT,
            SendMessage::toChat(Dummy::CHAT_ID)->withText(Dummy::CHAT_TEXT)->getBody()['text']
        );
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\ValueException
     */
    public function test_it_throw_exception_on_unknown_parse_method()
    {
        $this->expectException(ValueException::class);

        SendMessage::toChat(Dummy::CHAT_ID)->withText(Dummy::CHAT_TEXT)->setParseMode('java');
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     * @throws \Acamposm\TelegramBot\Exceptions\ValueException
     */
    public function test_i_can_assign_a_parse_method()
    {
        $this->assertEquals(
            ParseStyle::HTML,
            SendMessage::toChat(Dummy::CHAT_ID)
                ->withText(Dummy::CHAT_TEXT)
                ->setParseMode(ParseStyle::HTML)
                ->getBody()['parse_mode']
        );
    }

}
