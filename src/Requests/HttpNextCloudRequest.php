<?php

namespace Pulig\NextCloudAPI\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Pulig\NextCloudAPI\Exceptions\ConnectionException;
use Pulig\NextCloudAPI\Exceptions\InvalidResponse;
use Pulig\NextCloudAPI\Responses\NextCloudResponseInterface;

abstract class HttpNextCloudRequest implements NextCloudRequestInterface
{
    /**
     * HTTP client
     *
     * @var Client
     */
    protected Client $client;

    /**
     * HTTP method
     *
     * @return string
     */
    abstract public function getMethod(): string;

    /**
     * Request parameters
     *
     * @return array
     */
    abstract public function getParams(): array;

    /**
     * Request uri
     *
     * @return string
     */
    abstract public function getUri(): string;

    /**
     * Build response object from HTTP response
     *
     * @param ResponseInterface $response
     *
     * @return NextCloudResponseInterface
     * @throws InvalidResponse
     */
    abstract protected function parseResponse(ResponseInterface $response): NextCloudResponseInterface;

    /**
     * HttpNextCloudRequest constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send http request to NextCloud server and return parsed response
     *
     * @return NextCloudResponseInterface
     * @throws ConnectionException
     * @throws InvalidResponse
     */
    public function send(): NextCloudResponseInterface
    {
        try {
            $request = new Request($this->getMethod(), $this->getUri(), [
                'OCS-APIRequest' => 'true'
            ]);

            $response = $this->client->send($request, $this->getParams());
        } catch (ClientExceptionInterface $e) {
            throw new ConnectionException("Connection error. HTTP code {$e->getCode()}", 1);
        }

        return $this->parseResponse($response);
    }
}
