<?php


namespace Pulig\NextCloudAPI;

use Pulig\NextCloudAPI\InstructionSets\Users;

class API
{
    private Users $users;

    public function __construct(string $host, string $user, string $pass)
    {
        $httpClient = HttpClient::create($host, $user, $pass);

        $this->users = new Users($httpClient);
    }

    public function users(): Users
    {
        return $this->users;
    }
}
