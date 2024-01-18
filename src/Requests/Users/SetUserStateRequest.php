<?php

namespace Pulig\NextCloudAPI\Requests\Users;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Pulig\NextCloudAPI\Exceptions\InvalidResponse;
use Pulig\NextCloudAPI\Requests\HttpNextCloudRequest;
use Pulig\NextCloudAPI\Responses\NextCloudResponseInterface;
use Pulig\NextCloudAPI\Responses\Users\SetUserStateResponse;

class SetUserStateRequest extends HttpNextCloudRequest
{
    private string $userId;
    private bool $state;


    public function __construct(Client $client, string $userId, bool $state)
    {
        parent::__construct($client);

        $this->userId = $userId;
        $this->state = $state;
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getParams(): array
    {
        return [];
    }

    public function getUri(): string
    {
        return "users/{$this->userId}/" . ($this->state ? 'enable' : 'disable');
    }

    /**
     * @throws InvalidResponse
     */
    protected function parseResponse(ResponseInterface $response): NextCloudResponseInterface
    {
        return new SetUserStateResponse($response->getBody()->getContents());
    }
}
