<?php

namespace Acamposm\TelegramBot\Traits;

trait NotifiableMessage
{
    /**
     * Sends the message silently. Users will receive a notification with no sound.
     *
     * @required no
     * @var bool
     */
    protected bool $disable_notification;

    /**
     * Return the default value for disable_notification parameter.
     *
     * @return bool
     */
    private function getNotificationParameterValue(): bool
    {
        return $this->disable_notification ?? false;
    }
}