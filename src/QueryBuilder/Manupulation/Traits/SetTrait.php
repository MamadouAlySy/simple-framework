<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Traits;

trait SetTrait
{
    protected array $sets;

    public function set(array $sets): static
    {
        $this->sets = $sets;

        return $this;
    }

    public function getSets(): string
    {
        $sql = 'SET ';
        foreach ($this->sets as $key => $value) {
            $sql .= "$key = :$key, "; 
        }
        return substr($sql, 0, -2);
    }
}