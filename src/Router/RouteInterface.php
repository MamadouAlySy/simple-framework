<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Router;

interface RouteInterface
{
    /**
     * Get the value of path
     * 
     * @return string
     */
    public function getPath(): string;

    /**
     * Set the value of path
     *
     * @param string $path
     * @return static
     */
    public function setPath(string $path): static;

    /**
     * Get the value of callable
     *
     * @return array
     */
    public function getCallable(): array;

    /**
     * Set the value of callable
     *
     * @param array $callable
     * @return static
     */
    public function setCallable(array $callable): static;

    /**
     * Get the value of name
     * 
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Set the value of name
     *
     * @param string|null $name
     * @return static
     */
    public function setName(?string $name): static;
}