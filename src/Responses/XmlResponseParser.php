<?php

namespace Pulig\NextCloudAPI\Responses;

use Pulig\NextCloudAPI\Exceptions\InvalidResponse;
use SimpleXMLElement;

abstract class XmlResponseParser implements NextCloudResponseInterface
{
    /**
     * @var SimpleXMLElement
     */
    protected $response;


    /**
     * Build error message
     *
     * @return string
     * @throws InvalidResponse
     */
    abstract protected function parseErrorMessage(): string;


    /**
     * @throws InvalidResponse
     */
    public function __construct(string $xmlString)
    {
        libxml_use_internal_errors(true);
        $this->response = simplexml_load_string($xmlString);

        if (!($this->response instanceof SimpleXMLElement)) {
            throw new InvalidResponse('Invalid response.', 2);
        }
    }

    public function errorCode(): ?int
    {
        if ($this->success()) {
            return null;
        }

        return $this->statusCode();
    }

    /**
     * @throws InvalidResponse
     */
    public function errorMessage(): ?string
    {
        if ($this->success()) {
            return null;
        }

        return $this->parseErrorMessage();
    }

    protected function statusCode(): int
    {
        return intval($this->response->meta->statuscode);
    }
}
