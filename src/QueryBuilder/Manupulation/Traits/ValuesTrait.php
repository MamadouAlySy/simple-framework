<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Traits;

trait ValuesTrait
{
    protected array $values;

    public function values(array $values): static
    {
        $this->values = $values;

        return $this;
    }

    public function getValues(): string
    {
        $keys = array_keys($this->values);
        $fields = implode('`, `', $keys);
        $values = implode(', :', $keys);

        return "(`$fields`) VALUES(:$values)";
    }
}