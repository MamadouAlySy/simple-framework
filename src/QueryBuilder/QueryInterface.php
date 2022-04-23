<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder;

interface QueryInterface
{
    /**
     * Get the value of sql
     *
     * @return string
     */
    public function getSql(): string;

    /**
     * Set the value of sql
     *
     * @param string $sql
     * 
     * @return static
     */
    public function setSql(string $sql): static;

    /**
     * Get the value of parameters
     *
     * @return array
     */
    public function getParameters(): array;

    /**
     * Set the value of parameters
     *
     * @param array $parameters
     * 
     * @return static
     */
    public function setParameters(array $parameters): static;
}