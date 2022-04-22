<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Router;

class Route implements RouteInterface
{
    public function __construct(
        protected string $path,
        protected array $callable, 
        protected ?string $name = null
    ) {}

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @inheritDoc
     */
    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getCallable(): array
    {
        return $this->callable;
    }

    /**
     * @inheritDoc
     */
    public function setCallable(array $callable): static
    {
        $this->callable = $callable;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }
}