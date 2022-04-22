<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Http;

use MamadouAlySy\SimpleFramework\Bag\BagInterface;

interface RequestInterface extends HttpMessageInterface
{
    /**
     * Create a new request instance based on super globals
     *
     * @return static
     */
    public static function createFromGlobals(): static;

    /**
     * Get the value of method
     *
     * @return string
     */
    public function getMethod(): string;

    /**
     * Set the value of method
     *
     * @param string $method
     *
     * @return static
     */
    public function setMethod(string $method): static;

    /**
     * Get the value of uri
     *
     * @return string
     */
    public function getUri(): string;

    /**
     * Set the value of uri
     *
     * @param string $uri
     *
     * @return static
     */
    public function setUri(string $uri): static;

    /**
     * Get the value of parameters
     *
     * @return BagInterface
     */
    public function getParameters(): BagInterface;

    /**
     * Set the value of parameters
     *
     * @param array $parameters
     *
     * @return static
     */
    public function setParameters(array $parameters): static;
}