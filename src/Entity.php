<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework;

use MamadouAlySy\SimpleFramework\DatabaseConnection\DatabaseConnectionInterface;
use MamadouAlySy\SimpleFramework\QueryBuilder\Query;
use MamadouAlySy\SimpleFramework\QueryBuilder\QueryBuilder;
use MamadouAlySy\SimpleFramework\QueryBuilder\QueryBuilderInterface;

abstract class Entity
{
    const DEFAULT_IGNORED_DATA = ['table', 'ignored', 'primaryKey'];
    protected string $table;
    protected string $primaryKey = 'id';
    protected array $ignored = [];

    public function __construct()
    {
        $mapping = $this->mapping();
        foreach ($mapping as $key => $value) {
            $this->$key = $this->$value;
            unset($this->$value);
        }
    }

    public function getId(): int|string|null
    {
        $idKey = $this->primaryKey;

        return $this->{$idKey} ?? null;
    }

    public function setId(int|string|null $id): static
    {
        $idKey = $this->primaryKey;
        $this->{$idKey} = $id;

        return $this;
    }

    public function getData(): array
    {
        $data = get_object_vars($this);
        $dataToIgnore = array_merge(static::DEFAULT_IGNORED_DATA, $this->ignored);
        $mapping = $this->mapping();

        foreach ($dataToIgnore as $key) {
            unset($data[$key]);
        }

        foreach ($mapping as $key => $value) {
            if (isset($data[$key])) {
                $val = $data[$key];
                $data[$value] = $val;
                unset($data[$key]);
            }
        }

        unset($data[$this->primaryKey]);

        return $data;
    }

    public function mapping(): array
    {
        return [];
    }

    public function save(): bool
    {
        /**
         * @var QueryBuilder
         */
        $q = Kernel::getContainer()->get(QueryBuilderInterface::class);
        $data = $this->getData();
        $query = '';

        if (!$this->getId()) {
            $query = $q->insert()
                ->values($data)
                ->into($this->table)
                ->getQuery();
        } else {
            $query = $q->update($this->table)
                ->set($data)
                ->where($this->primaryKey, '=', $this->{$this->primaryKey})
                ->getQuery();
        }
        
        return $this->executeQuery($query);
    }

    protected function executeQuery(Query $query)
    {
        /**
         * @var DatabaseConnectionInterface
         */
        $connection = Kernel::getContainer()->get(DatabaseConnectionInterface::class);
        $pdoInstance = $connection->open();
        $pdoInstance->beginTransaction();
        $statement = $pdoInstance->prepare($query->getSql());
        
        if ($statement->execute($query->getParameters())) {
            $pdoInstance->commit();

            return true;
        }

        $pdoInstance->rollBack();
        
        return false;
    }
}