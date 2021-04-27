<?php


namespace Pulig\NextCloudAPI\Responses\Users;

use Pulig\NextCloudAPI\Responses\XmlResponseParser;

class SetUserStateResponse extends XmlResponseParser
{
    const STATUS_SUCCESS = 100;

    const STATUS_FAILURE = 101;


    public function data(): ?array
    {
        return [];
    }

    public function success(): bool
    {
        return $this->statusCode() == self::STATUS_SUCCESS;
    }

    protected function parseErrorMessage(): string
    {
        switch ($this->errorCode()) {
            case self::STATUS_FAILURE: return 'Failed to change user state';
        }

        return strval($this->response->meta->message ?? '');
    }
}
