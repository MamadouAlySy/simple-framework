<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder;

class Query implements QueryInterface
{
    public function __construct(protected string $sql, protected array $parameters = [])
    {}

    /**
     * @inheritDoc
     */
    public function getSql(): string
    {
        return $this->sql;
    }

    /**
     * @inheritDoc
     */
    public function setSql($sql): static
    {
        $this->sql = $sql;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @inheritDoc
     */
    public function setParameters($parameters): static
    {
        $this->parameters = $parameters;

        return $this;
    }
}