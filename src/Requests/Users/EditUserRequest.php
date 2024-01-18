<?php

namespace Pulig\NextCloudAPI\Requests\Users;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Pulig\NextCloudAPI\Exceptions\InvalidResponse;
use Pulig\NextCloudAPI\Requests\HttpNextCloudRequest;
use Pulig\NextCloudAPI\Responses\NextCloudResponseInterface;
use Pulig\NextCloudAPI\Responses\Users\EditUserResponse;

class EditUserRequest extends HttpNextCloudRequest
{
    private array $properties;

    private string $userId;

    public function __construct(Client $client, string $userId, array $properties)
    {
        parent::__construct($client);

        $this->userId = $userId;
        $this->properties = $properties;
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getParams(): array
    {
        return [
            'form_params' => $this->properties,
        ];
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
        return new EditUserResponse($response->getBody()->getContents());
    }
}
