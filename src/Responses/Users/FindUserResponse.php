<?php

namespace Pulig\NextCloudAPI\Responses\Users;

use Pulig\NextCloudAPI\Responses\XmlResponseParser;

class FindUserResponse extends XmlResponseParser
{
    public const STATUS_SUCCESS = 100;

    /**
     * User profile
     *
     * @return array
     */
    public function data(): ?array
    {
        if (!$this->success()) {
            return null;
        }

        $data = $this->response->data;

        return (array)$data->users->element;
    }

    protected function parseErrorMessage(): string
    {
        return strval($this->response->meta->message ?? '');
    }

    public function success(): bool
    {
        return $this->statusCode() == self::STATUS_SUCCESS;
    }
}
