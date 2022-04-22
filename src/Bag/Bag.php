<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Bag;

class Bag implements BagInterface
{
    public function __construct(protected array $items = []) {}

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->has($key) ? $this->items[$key] : $default;
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, mixed $value): static
    {
        $this->items[$key] = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function remove(string $key): void
    {
        if ($this->has($key)) {
            unset($this->items[$key]);
        }
    }
}