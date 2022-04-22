<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Container;

interface ContainerInterface
{
    /**
     * @inheritDoc
     */
    public function get(string $id): mixed;

    /**
     * @inheritDoc
     */
    public function has(string $id): bool;

    /**
     * @param string $id
     * @param callable|string $resolver
     */
    public function set(string $id, callable|string $resolver): void;

    /**
     * @param string $id
     * @param callable|string|object $resolver
     * @throws ContainerException
     * @throws ReflectionException
     */
    public function makeSingleton(string $id, callable|string|object $resolver): void;

    /**
     * @param ReflectionParameter[] $parameters
     * @return object[]
     * @throws ContainerException
     */
    public function resolveDependencies(array $parameters): array;
}