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
    public function test_it_can_create_a_new_instance(): SendMessage
    {
        $instance = new SendMessage();

        $this->assertInstanceOf(SendMessage::class, $instance);

        return $instance;
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     */
    public function test_it_throw_exception_if_no_chat_id_is_assigned()
    {
        $instance = new SendMessage();
        $instance->setText(Dummy::CHAT_TEXT);

        $this->expectException(RequiredParameterException::class);

        $instance->getBody();
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     */
    public function test_i_can_assign_a_chat_id()
    {
        $instance = new SendMessage();
        $instance->setChatId(Dummy::CHAT_ID);
        $instance->setText(Dummy::CHAT_TEXT);

        $this->assertEquals(Dummy::CHAT_ID, $instance->getBody()['chat_id']);
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     */
    public function test_it_throw_exception_if_no_text_is_assigned()
    {
        $instance = new SendMessage();
        $instance->setChatId(Dummy::CHAT_ID);

        $this->expectException(RequiredParameterException::class);

        $instance->getBody();
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     */
    public function test_i_can_assign_a_text()
    {
        $instance = new SendMessage();
        $instance->setChatId(Dummy::CHAT_ID);
        $instance->setText(Dummy::CHAT_TEXT);

        $this->assertEquals(Dummy::CHAT_TEXT, $instance->getBody()['text']);
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\ValueException
     */
    public function test_it_throw_exception_on_unknown_parse_method()
    {
        $instance = new SendMessage();
        $instance->setChatId(Dummy::CHAT_ID);
        $instance->setText(Dummy::CHAT_TEXT);

        $this->expectException(ValueException::class);

        $instance->setParseMode('java');
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\RequiredParameterException
     * @throws \Acamposm\TelegramBot\Exceptions\ValueException
     */
    public function test_i_can_assign_a_parse_method()
    {
        $instance = new SendMessage();
        $instance->setChatId(Dummy::CHAT_ID);
        $instance->setText(Dummy::CHAT_TEXT);
        $instance->setParseMode(ParseStyle::HTML);

        $this->assertEquals(ParseStyle::HTML, $instance->getBody()['parse_mode']);
    }

}
