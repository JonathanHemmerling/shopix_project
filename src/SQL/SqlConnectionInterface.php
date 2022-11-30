<?php

declare(strict_types=1);

namespace App\SQL;

use PDO;

interface SqlConnectionInterface
{
    public function connectToDatabase(string $dsn, string $database, string $user, string $password, string $port): PDO;

    public function disconnectFromDatabase($connection);

    public function db_escape($connection, $string);

    public function confirm_db_connect();

    public function confirm_result_set($result_set);
}