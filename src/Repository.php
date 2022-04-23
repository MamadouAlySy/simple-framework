<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework;

use MamadouAlySy\SimpleFramework\DatabaseConnection\DatabaseConnectionInterface;
use MamadouAlySy\SimpleFramework\QueryBuilder\Query;
use MamadouAlySy\SimpleFramework\QueryBuilder\QueryBuilderInterface;
use PDO;

abstract class Repository
{
    protected string $table;
    protected string $entity;

    public function __construct(
        protected DatabaseConnectionInterface $connection, 
        protected QueryBuilderInterface $queryBuilder
    ) {}

    public function findAllBy(string $field, string $operator, mixed $value, bool $one = false): mixed
    {
        $query = $this->queryBuilder
            ->select()
            ->from($this->table)
            ->where($field, $operator, $value)
            ->getQuery();

        return $this->fetch($query, $one);
    }

    public function findAll(): array
    {
        $query = $this->queryBuilder
            ->select()
            ->from($this->table)
            ->getQuery();

        return $this->fetch($query);
    }

    public function findOneBy(string $field, string $operator, mixed $value): mixed
    {
        return $this->findAllBy($field, $operator, $value, true);
    }

    public function findById(int $id): object
    {
        return $this->findOneBy('id', '=', $id);
    }

    protected function fetch(Query $query, bool $one = false): mixed
    {
        $statement = $this->connection->open()->prepare($query->getSql());
        $statement->setFetchMode(PDO::FETCH_CLASS, $this->entity);

        if ($statement->execute($query->getParameters()) && $statement->rowCount() > 0) {
            return $one ? $statement->fetch() : $statement->fetchAll();
        }

        return  $one ? null : [];
    }
}