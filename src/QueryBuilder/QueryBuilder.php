<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder;

use MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Insert;
use MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Select;
use MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Update;

class QueryBuilder implements QueryBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function insert(): Insert
    {
        return new Insert();
    }

    /**
     * @inheritDoc
     */
    public function update(string $table): Update
    {
        return new Update($table);
    }

    /**
     * @inheritDoc
     */
    public function select(string ...$fields): Select
    {
        return new Select(func_get_args());
    }
}