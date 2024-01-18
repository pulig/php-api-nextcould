<?php

namespace Pulig\NextCloudAPI\Requests\Users;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Pulig\NextCloudAPI\Exceptions\InvalidResponse;
use Pulig\NextCloudAPI\Requests\HttpNextCloudRequest;
use Pulig\NextCloudAPI\Responses\NextCloudResponseInterface;
use Pulig\NextCloudAPI\Responses\Users\DeleteUserResponse;

class DeleteUserRequest extends HttpNextCloudRequest
{
    private string $userId;


    public function __construct(Client $client, string $userId)
    {
        parent::__construct($client);

        $this->userId = $userId;
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getParams(): array
    {
        return [];
    }

    public function getUri(): string
    {
        return "users/{$this->userId}";
    }

    /**
     * @throws InvalidResponse
     */
    protected function parseResponse(ResponseInterface $response): NextCloudResponseInterface
    {
        return new DeleteUserResponse($response->getBody()->getContents());
    }
}
