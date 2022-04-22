<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Http;

interface ResponseInterface
{
    /**
     * Get the value of statusCode
     *
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * Set the value of statusCode
     *
     * @param int $statusCode
     *
     * @return static
     */
    public function setStatusCode(int $statusCode): static;

    /**
     * Get the value of body
     *
     * @return string
     */
    public function getBody(): string;

    /**
     * Set the value of body
     *
     * @param string $body
     *
     * @return static
     */
    public function setBody(string $body): static;

    /**
     * Send the response
     *
     * @return void
     */
    public function send(): void;
}