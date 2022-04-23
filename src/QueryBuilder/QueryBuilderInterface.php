<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder;

use MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Insert;
use MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Select;
use MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Update;

interface QueryBuilderInterface
{
    /**
     * Build insert query
     *
     * @return Insert
     */
    public function insert(): Insert;

    /**
     * Build update query
     *
     * @param string $table
     * 
     * @return Update
     */
    public function update(string $table): Update;

    /**
     * Build select query
     *
     * @param string ...$fields
     * 
     * @return Select
     */
    public function select(string ...$fields): Select;
}