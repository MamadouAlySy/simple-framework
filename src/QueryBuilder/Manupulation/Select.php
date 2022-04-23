<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation;

use MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Traits\ConditionTrait;
use MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Traits\FromTrait;
use MamadouAlySy\SimpleFramework\QueryBuilder\Statement;

class Select extends Statement
{
    use FromTrait;
    use ConditionTrait;
    
    protected string $selectedFields;

    public function __construct(array $fields)
    {
        $this->selectedFields = empty($fields) ? '*' : implode(', ', $fields);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toSql(): string
    {
        return 'SELECT ' . $this->selectedFields . $this->getFrom() . ' ' . $this->getConditions();
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return $this->conditionValues;
    }
}