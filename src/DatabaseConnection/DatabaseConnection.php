<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\DatabaseConnection;

use MamadouAlySy\SimpleFramework\DatabaseConnection\Exception\DatabaseConnectionException;
use PDO;
use PDOException;

class DatabaseConnection implements DatabaseConnectionInterface
{
    protected  ?PDO $pdoInstance = null;

    public function __construct(protected array $credentials = [], protected array $options = [])
    {}

    /**
     * @inheritDoc
     */
    public function open() : PDO
    {
        if ($this->isClosed()) {
            try {
                $this->pdoInstance = new PDO(
                    $this->credentials['dsn'],
                    $this->credentials['user'] ?? null,
                    $this->credentials['password'] ?? null,
                    $this->options
                );
            } catch (PDOException $e) {
                throw new DatabaseConnectionException($e->getMessage(), (int) $e->getCode());
            }
        }

        return $this->pdoInstance;
    }

    /**
     * @inheritDoc
     */
    public function close(): void
    {
        $this->pdoInstance = null;
    }

    /**
     * Check if the connection is closed
     *
     * @return boolean
     */
    public function isClosed(): bool
    {
        return is_null($this->pdoInstance);
    }
}