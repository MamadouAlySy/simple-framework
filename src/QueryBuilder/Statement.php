<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder;

abstract class Statement
{
    protected array $parameters = [];
    
    /**
     * Returns the sql query
     *
     * @return string
     */
    abstract public function toSql(): string;

    /**
     * Returns query parameters
     *
     * @return array
     */
    abstract public function getParameters(): array;

    /**
     * Retuns a query
     *
     * @return QueryInterface
     */
    public function getQuery(): QueryInterface
    {
        return new Query($this->toSql(), $this->getParameters());
    }
}