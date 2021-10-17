<?php

/*
 * This file is part of acamposm\laravel-telegram-bot package.
 *
 * Copyright (c) Angel Campos Muñoz <angel.campos.m@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acamposm\TelegramBot\Tests\Unit;

use Acamposm\TelegramBot\API\Types\InlineKeyboardButton;
use Acamposm\TelegramBot\Enums\Dummy;
use PHPUnit\Framework\TestCase;

class CreateInlineButtonTest extends TestCase
{
    public function test_can_create_a_new_instance(): InlineKeyboardButton
    {
        $instance = InlineKeyboardButton::create()
            ->withText(Dummy::BUTTON_TEXT)
            ->withUrl(Dummy::BUTTON_URL);

        $this->assertInstanceOf(InlineKeyboardButton::class, $instance);

        return $instance;
    }

    /**
     * @depends test_can_create_a_new_instance
     */
    public function test_expect_dummy_button(InlineKeyboardButton $button)
    {
        $expected = [
            'text' => Dummy::BUTTON_TEXT,
            'url' => Dummy::BUTTON_URL,
        ];

        $this->assertEquals($expected, $button->get());
    }
}
