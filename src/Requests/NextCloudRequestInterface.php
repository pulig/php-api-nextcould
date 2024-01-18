<?php

namespace Pulig\NextCloudAPI\Requests;

use Pulig\NextCloudAPI\Exceptions\ConnectionException;
use Pulig\NextCloudAPI\Exceptions\InvalidResponse;
use Pulig\NextCloudAPI\Responses\NextCloudResponseInterface;

interface NextCloudRequestInterface
{
    /**
     * Send request to NextCloud server, return formatted response
     *
     * @return NextCloudResponseInterface
     * @throws ConnectionException
     * @throws InvalidResponse
     */
    public function send(): NextCloudResponseInterface;
}
