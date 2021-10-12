<?php

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