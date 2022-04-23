<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation;

use MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Traits\ConditionTrait;
use MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Traits\SetTrait;
use MamadouAlySy\SimpleFramework\QueryBuilder\Statement;

class Update extends Statement
{
    use SetTrait;
    use ConditionTrait;

    public function __construct(protected string $table)
    {}

    /**
     * @inheritDoc
     */
    public function toSql(): string
    {
        return 'UPDATE ' . $this->table . ' ' . $this->getSets() . ' ' . $this->getConditions();
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return array_merge($this->sets, $this->conditionValues);
    }
}