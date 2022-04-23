<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Traits;

trait ConditionTrait
{
    protected array $conditions = [];
    protected array $conditionValues = [];
    protected bool $hasCondition = false;

    public function where(string $field, string $operator, mixed $value, string $type = 'AND'): static
    {
        $this->hasCondition = true;
        $this->conditions[] = "$type $field $operator :cond_$field";
        $this->conditionValues["cond_$field"] = $value;

        return $this;
    }

    public function orWhere(string $field, string $operator, mixed $value): static
    {
        return $this->where($field, $operator, $value, 'OR');
    }

    public function getConditions(): string
    {
        if ($this->hasCondition) {
            $conditions = implode(' ', $this->conditions);
            $conditions = ltrim($conditions, 'AND');
            $conditions = ltrim($conditions, 'OR');

            return 'WHERE ' . $conditions;
        }

        return '';
    }
}