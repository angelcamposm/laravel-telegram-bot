<?php

namespace Acamposm\TelegramBot;

use Acamposm\TelegramBot\Contracts\RequestMethod;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use ReflectionClass;

class Request
{
    /**
     * Telegram Request Constructor.
     *
     * @param \Acamposm\TelegramBot\Contracts\RequestMethod $method
     */
    public function __construct(
        protected RequestMethod $method
    ) { }

    /**
     * Return an instance of Request.
     *
     * @param \Acamposm\TelegramBot\Contracts\RequestMethod $method
     *
     * @return \Acamposm\TelegramBot\Request
     */
    public static function fromMethod(RequestMethod $method): Request
    {
        return new static($method);
    }

    /**
     * Send a GET Request to the Telegram API.
     *
     * @return \Illuminate\Http\Client\Response
     * @throws \Acamposm\TelegramBot\Exceptions\BotConfigurationException
     */
    public function get()
    {
        $request = $this->getTelegramPendingRequest();

        return $request->get(
            $this->getUrl()
        );
    }

    /**
     * Send a POST Request to the Telegram API.
     *
     * @return \Illuminate\Http\Client\Response
     * @throws \Acamposm\TelegramBot\Exceptions\BotConfigurationException
     */
    public function post()
    {
        $request = $this->getTelegramPendingRequest();

        return $request->post(
            $this->getUrl()
        );
    }

    public function getTelegramPendingRequest(): PendingRequest
    {
        return Http::withHeaders($this->getHeaders())
            ->withOptions($this->getOptions());
    }

    /**
     * Return an array with the headers for the request.
     *
     * @return string[]
     */
    private function getHeaders(): array
    {
        return [
            'Accept' => 'Application/Json',
            'Content-Type' => 'Application/Json',
        ];
    }

    /**
     * Return an array with the options for the request.
     *
     * @return false[]
     */
    private function getOptions(): array
    {
        return [
            'verify' => false,
        ];
    }

    /**
     * Return the URL of the Telegram REST API.
     *
     * @throws \Acamposm\TelegramBot\Exceptions\BotConfigurationException
     */
    private function getUrl(): string
    {
        return Bot::Api().$this->getMethod();
    }

    /**
     * Return the name of the method to be used.
     *
     * @return string
     */
    private function getMethod(): string
    {
        return (new ReflectionClass($this->method))->getShortName();
    }

    /**
     * Return an array with the related information for the request.
     *
     * @return array
     * @throws \Acamposm\TelegramBot\Exceptions\BotConfigurationException
     */
    public function toArray(): array
    {
        return [
            'headers' => $this->getHeaders(),
            'method' => $this->getMethod(),
            'options' => $this->getOptions(),
            'url' => $this->getUrl()
        ];
    }
}