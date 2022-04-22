<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Http;

use MamadouAlySy\SimpleFramework\Bag\Bag;
use MamadouAlySy\SimpleFramework\Bag\BagInterface;

class HttpMessage implements HttpMessageInterface
{
    protected Bag $headers;

    public function __construct(array $headers = [])
    {
        $this->headers = new Bag($headers);
    }

    /**
     * Get the value of headers
     *
     * @return BagInterface
     */
    public function getHeaders(): BagInterface
    {
        return $this->headers;
    }

    /**
     * Set the value of headers
     *
     * @param array $headers
     *
     * @return static
     */
    public function setHeaders(array $headers): static
    {
        $this->headers = new Bag($headers);

        return $this;
    }
}