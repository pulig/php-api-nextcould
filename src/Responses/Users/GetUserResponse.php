<?php

namespace Pulig\NextCloudAPI\Responses\Users;

use Pulig\NextCloudAPI\Responses\XmlResponseParser;

class GetUserResponse extends XmlResponseParser
{
    public const STATUS_SUCCESS = 100;

    public const STATUS_DOES_NOT_EXIST = 404;

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

        $loginTime = (int)(intval($data->lastLogin) / 1000);

        return [
            'id'        => strval($data->id),
            'enabled'   => !empty($data->enabled), // For disabled user we receive empty SimpleXMLElement
            'name'      => strval($data->displayname),
            'quota'     => [
                'limit' => intval($data->quota->quota),
                'used' => intval($data->quota->used),
            ],
            'lastLogin' => $loginTime === 0 ? null : date('Y-m-d H:i:s', $loginTime),
            'groups'    => array_map(function ($group) {
                return strval($group);
            }, (array)$data->groups->element),
        ];
    }

    protected function parseErrorMessage(): string
    {
        switch ($this->errorCode()) {
            case self::STATUS_DOES_NOT_EXIST:
                return 'User not found';
        }

        return strval($this->response->meta->message ?? '');
    }

    public function success(): bool
    {
        return $this->statusCode() == self::STATUS_SUCCESS;
    }
}
