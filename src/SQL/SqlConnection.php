<?php

declare(strict_types=1);

namespace App\SQL;

use PDO;

class SqlConnection implements SqlConnectionInterface
{
    public function __construct()
    {
    }

    public function connectToDatabase(string $dsn, string $database, string $user, string $password, string $port): PDO
    {
        return new PDO("mysql:host=$dsn;dbname=$database;port=$port", $user, $password);
    }

    public function disconnectFromDatabase($connection): void
    {
        if (isset($connection)) {
            mysqli_close($connection);
        }
    }

    public function db_escape($connection, $string): string
    {
        return mysqli_real_escape_string($connection, $string);
    }

    public function confirm_db_connect(): void
    {
        if (mysqli_connect_errno()) {
            $msg = "Database connection failed: ";
            $msg .= mysqli_connect_error();
            $msg .= " (" . mysqli_connect_errno() . ")";
            exit($msg);
        }
    }

    public function confirm_result_set($result_set):void {
        if (!$result_set) {
            exit("Database query failed.");
        }
    }
}