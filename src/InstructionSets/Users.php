<?php


namespace Pulig\NextCloudAPI\InstructionSets;

use GuzzleHttp\Client;
use Pulig\NextCloudAPI\Exceptions\ConnectionException;
use Pulig\NextCloudAPI\Exceptions\InvalidResponse;
use Pulig\NextCloudAPI\Requests\Users\CreateUserRequest;
use Pulig\NextCloudAPI\Requests\Users\DeleteUserRequest;
use Pulig\NextCloudAPI\Requests\Users\FindUserRequest;
use Pulig\NextCloudAPI\Requests\Users\GetUserRequest;
use Pulig\NextCloudAPI\Requests\Users\SetUserStateRequest;
use Pulig\NextCloudAPI\Requests\Users\EditUserRequest;
use Pulig\NextCloudAPI\Responses\NextCloudResponseInterface;
use Pulig\NextCloudAPI\Responses\ResponseInterface;

class Users
{
    /**
     * @var Client
     */
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }


    /**
     * @throws ConnectionException
     * @throws InvalidResponse
     */
    public function create(array $properties): NextCloudResponseInterface
    {
        $request = new CreateUserRequest($this->httpClient, $properties);

        return $request->send();
    }

    /**
     * @throws InvalidResponse
     * @throws ConnectionException
     */
    public function update(string $userId, array $properties): NextCloudResponseInterface
    {
        $request = new EditUserRequest($this->httpClient, $userId, $properties);

        return $request->send();
    }

    /**
     * @throws ConnectionException
     * @throws InvalidResponse
     */
    public function delete(string $userId): NextCloudResponseInterface
    {
        $request = new DeleteUserRequest($this->httpClient, $userId);

        return $request->send();
    }

    /**
     * @throws ConnectionException
     * @throws InvalidResponse
     */
    public function enable(string $userId): NextCloudResponseInterface
    {
        return $this->setState($userId, true);
    }

    /**
     * @throws ConnectionException
     * @throws InvalidResponse
     */
    public function disable(string $userId): NextCloudResponseInterface
    {
        return $this->setState($userId, false);
    }

    /**
     * Search users database, return list of users ids
     *
     * @param string $keyword
     * @param int    $limit
     * @param int    $offset
     *
     * @return NextCloudResponseInterface
     * @throws ConnectionException
     * @throws InvalidResponse
     */
    public function find(string $keyword, $limit = 50, $offset = 0): NextCloudResponseInterface
    {
        $request = new FindUserRequest($this->httpClient, $keyword, $limit, $offset);

        return $request->send();
    }

    /**
     * @param string $userId
     *
     * @return NextCloudResponseInterface
     * @throws ConnectionException
     * @throws InvalidResponse
     */
    public function get(string $userId): NextCloudResponseInterface
    {
        $request = new GetUserRequest($this->httpClient, $userId);

        return $request->send();
    }

    /**
     * @throws ConnectionException
     * @throws InvalidResponse
     */
    public function setState(string $userId, bool $state): NextCloudResponseInterface
    {
        $request = new SetUserStateRequest($this->httpClient, $userId, $state);

        return $request->send();
    }
}
