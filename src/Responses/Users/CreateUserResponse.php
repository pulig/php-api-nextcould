<?php

namespace Pulig\NextCloudAPI\Responses\Users;

use Pulig\NextCloudAPI\Responses\XmlResponseParser;

class CreateUserResponse extends XmlResponseParser
{
    public const STATUS_SUCCESS = 100;

    public const STATUS_FAILURE = 101;

    public const STATUS_ALREADY_EXISTS = 102;

    public const STATUS_UNKNOWN = 103;

    public const STATUS_GRP_NOT_FOUND = 104;

    public const STATUS_GRP_NO_PERMISSION = 105;

    public const STATUS_NO_GRP = 106;

    public const STATUS_HAS_HINT = 107;

    public const STATUS_NO_PWD_OR_MAIL = 108;

    public const STATUS_INVITE_FAILURE = 109;

    public const STATUS_INVALID_PARAMS = 998;


    public function data(): ?array
    {
        return [
            'userid' => strval($this->response->data->id),
        ];
    }

    public function success(): bool
    {
        return $this->statusCode() == self::STATUS_SUCCESS;
    }

    protected function parseErrorMessage(): string
    {
        switch ($this->errorCode()) {
            case self::STATUS_FAILURE: return 'Invalid parameters';
            case self::STATUS_ALREADY_EXISTS: return 'User already exists';
            case self::STATUS_UNKNOWN: return 'Unknown error';
            case self::STATUS_NO_GRP: return 'No group specified. Required for sub-admins';
            case self::STATUS_NO_PWD_OR_MAIL: return 'No password or email';
            case self::STATUS_INVITE_FAILURE: return 'Failed to send invite';
            case self::STATUS_INVALID_PARAMS: return 'Invalid parameter format';


            case self::STATUS_GRP_NOT_FOUND:
            case self::STATUS_GRP_NO_PERMISSION:
            case self::STATUS_HAS_HINT:
                return strval($this->response->meta->message ?? '');
        }

        return strval($this->response->meta->message ?? '');
    }
}
