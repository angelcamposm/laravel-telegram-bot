<?php

namespace Acamposm\TelegramBot;

use Acamposm\TelegramBot\Contracts\RequestMethod;
use Acamposm\TelegramBot\Enums\HttpRequestMethod;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request as GuzzleHttpRequest;
use Psr\Http\Message\ResponseInterface;
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
     * Send a request and returns a ResponseInterface
     *
     * @throws \Acamposm\TelegramBot\Exceptions\BotConfigurationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(): ResponseInterface
    {
        $client = new GuzzleHttpClient();

        return $client->send($this->getRequestInstance(), $this->getOptions());
    }

    /**
     * Return an instance of GuzzleHttp\Request with configuration.
     *
     * @throws \Acamposm\TelegramBot\Exceptions\BotConfigurationException
     */
    private function getRequestInstance(): GuzzleHttpRequest
    {
        return new GuzzleHttpRequest(
            HttpRequestMethod::POST,
            $this->getUrl(),
            $this->getHeaders(),
            $this->getBody(),
        );
    }

    /**
     * Return a formated JSON string with the body of the request.
     *
     * @return string
     */
    private function getBody(): string
    {
        return json_encode($this->method->getBody());
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
            'Accept-Charset' => 'UTF-8',
            'Content-Type' => 'Application/Json',
            'User-Agent' => self::getUserAgent(),
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
     * Builds a dummy user agent string.
     *
     * @return string
     */
    private static function getUserAgent(): string
    {
        $gversion = ClientInterface::MAJOR_VERSION;
        $pversion = phpversion();
        $zversion = zend_version();

        return "GuzzleHttp/{$gversion} PHP/{$pversion} Zend Engine/{$zversion}";
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
            'telegram' => [
                'bot' => [
                    'name' => Bot::Name(),
                    'token' => Bot::Token(),
                ],
                'method' => $this->getMethod(),
                'url' => $this->getUrl(),
            ],
            'request' => [
                'body' => $this->method->getBody(),
                'headers' => $this->getHeaders(),
                'options' => $this->getOptions(),
            ],
        ];
    }

    /**
     * Return an object with the details of the request.
     *
     * @return object
     * @throws \Acamposm\TelegramBot\Exceptions\BotConfigurationException
     */
    public function toObject(): object
    {
        return json_decode(
            json_encode($this->toArray(), JSON_PRETTY_PRINT)
        );
    }
}