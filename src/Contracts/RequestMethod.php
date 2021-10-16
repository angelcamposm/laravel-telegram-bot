<?php

/*
 * This file is part of acamposm\laravel-telegram-bot package.
 *
 * Copyright (c) Angel Campos Muñoz <angel.campos.m@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acamposm\TelegramBot\Contracts;

interface RequestMethod
{
    /**
     * Returns the body for the request.
     *
     * @return array
     */
    public function getBody(): array;
}