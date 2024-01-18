<?php

namespace Pulig\NextCloudAPI\Responses;

interface NextCloudResponseInterface
{
    /**
     * Response data or null on failure
     *
     * @return array
     */
    public function data(): ?array;

    /**
     * Error code or null on success
     *
     * @return int|null
     */
    public function errorCode(): ?int;

    /**
     * Error message or null on success
     *
     * @return string|null
     */
    public function errorMessage(): ?string;

    /**
     * Whether the request was successful
     *
     * @return bool
     */
    public function success(): bool;
}
