<?php


namespace Pulig\NextCloudAPI\Requests\Users;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Pulig\NextCloudAPI\Exceptions\InvalidResponse;
use Pulig\NextCloudAPI\Requests\HttpNextCloudRequest;
use Pulig\NextCloudAPI\Responses\NextCloudResponseInterface;
use Pulig\NextCloudAPI\Responses\Users\CreateUserResponse;

class CreateUserRequest extends HttpNextCloudRequest
{
    private array $properties;

    public function __construct(Client $client, array $properties)
    {
        parent::__construct($client);

        $this->properties = $properties;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getParams(): array
    {
        return [
            'form_params' => $this->properties,
        ];
    }

    public function getUri(): string
    {
        return 'users';
    }

    /**
     * @throws InvalidResponse
     */
    protected function parseResponse(ResponseInterface $response): NextCloudResponseInterface
    {
        return new CreateUserResponse($response->getBody()->getContents());
    }
}
