<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Traits;

trait IntoTait
{
    protected string $table;

    public function into(string $table): static
    {
        $this->table = $table;

        return $this;
    }

    public function getInto(): string
    {
        return ' INTO ' . $this->table;
    }
}