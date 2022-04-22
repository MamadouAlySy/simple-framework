<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Http;

use MamadouAlySy\SimpleFramework\Bag\Bag;
use MamadouAlySy\SimpleFramework\Bag\BagInterface;

class Request extends HttpMessage implements RequestInterface
{
    protected string $method;
    protected string $uri;
    protected BagInterface $parameters;

    /**
     * @param string $method
     * @param string $uri
     * @param array $headers
     * @param array $parameters
     */
    public function __construct(string $method = 'GET', string $uri = '/', array $headers = [], array $parameters = [])
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->parameters = new Bag($parameters);
        parent::__construct($headers);
    }

    /**
     * @inheritDoc
     */
    public static function createFromGlobals(): static
    {
        $uri = $_SERVER['REQUEST_URI'];
        
        if (strpos($uri, '?')) {
            $uri = explode('?', $uri)[0];
        }

        return new static($_SERVER['REQUEST_METHOD'], $uri, headers_list(), $_REQUEST);
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @inheritDoc
     */
    public function setMethod(string $method): static
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @inheritDoc
     */
    public function setUri(string $uri): static
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): BagInterface
    {
        return $this->parameters;
    }

    /**
     * @inheritDoc
     */
    public function setParameters(array $parameters): static
    {
        $this->parameters = new Bag($parameters);

        return $this;
    }
}