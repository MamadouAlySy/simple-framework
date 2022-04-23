<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\DatabaseConnection;

use PDO;

interface DatabaseConnectionInterface
{
    /**
     * Open a database connection and return a PDO instance if the coneection successfull
     *
     * @return PDO|null
     * @throws ConnectionException
     */
    public function open(): ?PDO;

    /**
     * Close the database connection
     *
     * @return void
     */
    public function close(): void;
}