<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Http;

class Response extends HttpMessage implements ResponseInterface
{
    protected int $statusCode;
    protected string $body;
    
    public function __construct(int $statusCode = 200, string $body = '', array $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
        parent::__construct($headers);
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @inheritDoc
     */
    public function setStatusCode(int $statusCode): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @inheritDoc
     */
    public function setBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function send(): void
    {
        http_response_code($this->statusCode);
        foreach ($this->headers->all() as $key => $value) {
            header("$key: $value");
            if (strtolower($key) == "location") {
                break;
            }
        }
        echo $this->body;
        exit;
    }
}