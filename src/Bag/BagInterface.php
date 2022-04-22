<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Bag;

interface BagInterface
{
    /**
     * Return all items
     *
     * @return array
     */
    public function all(): array;

    /**
     * Checks if there is a value with the given key
     *
     * @param string $key
     * 
     * @return boolean
     */
    public function has(string $key): bool;

    /**
     * Returns the value of the given key
     *
     * @param string $key
     * @param mixed $default
     * 
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Add a new value with the given key
     *
     * @param string $key
     * @param mixed $value
     * 
     * @return static
     */
    public function set(string $key, mixed $value): static;

    /**
     * Remove the value of the given key
     *
     * @param string $key
     * 
     * @return void
     */
    public function remove(string $key): void;
}