<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Traits;

trait FromTrait
{
    protected string $table;

    public function from(string $table): static
    {
        $this->table = $table;

        return $this;
    }

    public function getFrom(): string
    {
        return ' FROM ' . $this->table;
    }
}