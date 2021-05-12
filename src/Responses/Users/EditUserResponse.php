<?php


namespace Pulig\NextCloudAPI\Responses\Users;

use Pulig\NextCloudAPI\Responses\XmlResponseParser;

class EditUserResponse extends XmlResponseParser
{
    const STATUS_SUCCESS = 100;

    const STATUS_USER_NOT_FOUND = 101;

    const STATUS_INVALID_PARAMS = 102;


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
            case self::STATUS_USER_NOT_FOUND: return 'User not found';
            case self::STATUS_INVALID_PARAMS: return 'Invalid parameters';
        }

        return strval($this->response->meta->message ?? '');
    }
}
