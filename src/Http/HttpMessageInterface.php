<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Http;

use MamadouAlySy\SimpleFramework\Bag\BagInterface;

interface HttpMessageInterface
{
    /**
     * Get the value of headers
     *
     * @return BagInterface
     */
    public function getHeaders(): BagInterface;

    /**
     * Set the value of headers
     *
     * @param array $headers
     *
     * @return static
     */
    public function setHeaders(array $headers): static;
}