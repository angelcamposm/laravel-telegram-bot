<?php

/*
 * This file is part of acamposm\<package> package.
 *
 * Copyright (c) Angel Campos Muñoz <angel.campos.m@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acamposm\TelegramBot\Tests\Feature;

use Acamposm\TelegramBot\API\Types\InlineKeyboardButton;
use Acamposm\TelegramBot\API\Types\InlineKeyboardMarkup;
use Acamposm\TelegramBot\Enums\Dummy;
use PHPUnit\Framework\TestCase;

class CreateReplyMarkupTest extends TestCase
{
    public function test_can_create_a_button(): InlineKeyboardButton
    {
        $button = InlineKeyboardButton::create()
            ->withText(Dummy::BUTTON_TEXT)
            ->withUrl(Dummy::BUTTON_URL);

        $this->assertInstanceOf(InlineKeyboardButton::class, $button);

        return $button;
    }

    /**
     * @depends test_can_create_a_button
     * @param \Acamposm\TelegramBot\API\Types\InlineKeyboardButton $button
     * @return array
     */
    public function test_can_create_a_button_row(InlineKeyboardButton $button): array
    {
        $sample = [
            [
                'text' => Dummy::BUTTON_TEXT,
                'url' => Dummy::BUTTON_URL,
            ]
        ];

        $row = [
            $button->get(),
        ];

        $this->assertEquals($sample, $row);

        return $row;
    }

    /**
     * @throws \Acamposm\TelegramBot\Exceptions\ValueException
     */
    public function test_can_create_a_keyboard_markup(): InlineKeyboardMarkup
    {
        $keyboard = InlineKeyboardMarkup::create();

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $keyboard);

        return $keyboard;
    }

    /**
     * @depends test_can_create_a_button_row
     * @depends test_can_create_a_keyboard_markup
     */
    public function test_keyboard_markup_is_the_same_as_provided_sample(array $row, InlineKeyboardMarkup $keyboard)
    {
        $sample = json_encode([
            'inline_keyboard' => [
                [
                    [
                        'text' => Dummy::BUTTON_TEXT,
                        'url' => Dummy::BUTTON_URL,
                    ],
                ],
            ],
        ]);

        $this->assertEquals($sample, $keyboard->withRow($row)->get());
    }
}
