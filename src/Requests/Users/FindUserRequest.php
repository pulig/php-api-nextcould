<?php


namespace Pulig\NextCloudAPI\Requests\Users;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Pulig\NextCloudAPI\Exceptions\InvalidResponse;
use Pulig\NextCloudAPI\Requests\HttpNextCloudRequest;
use Pulig\NextCloudAPI\Responses\NextCloudResponseInterface;
use Pulig\NextCloudAPI\Responses\Users\FindUserResponse;

class FindUserRequest extends HttpNextCloudRequest
{
    private string $keyword;

    private int $limit;

    private int $offset;


    public function __construct(Client $client, string $keyword, int $limit, int $offset)
    {
        parent::__construct($client);

        $this->keyword = $keyword;
        $this->limit = $limit;
        $this->offset = $offset;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getParams(): array
    {
        return [
            'query' => [
                'search' => $this->keyword,
                'limit'  => $this->limit,
                'offset' => $this->offset,
            ],
        ];
    }

    public function getUri(): string
    {
        return "users";
    }

    /**
     * @throws InvalidResponse
     */
    protected function parseResponse(ResponseInterface $response): NextCloudResponseInterface
    {
        return new FindUserResponse($response->getBody()->getContents());
    }
}
