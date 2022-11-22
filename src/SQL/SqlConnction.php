<?php

declare(strict_types=1);

class SqlConnction
{
    public function __construct()
    {
    }

    public function connectToDatabase(): bool|mysqli
    {
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        confirm_db_connect();
        return $connection;
    }

    public function disconnectFromDatabase($connection)
    {
        if (isset($connection)) {
            mysqli_close($connection);
        }
    }

    public function db_escape($connection, $string)
    {
        return mysqli_real_escape_string($connection, $string);
    }

    public function confirm_db_connect()
    {
        if (mysqli_connect_errno()) {
            $msg = "Database connection failed: ";
            $msg .= mysqli_connect_error();
            $msg .= " (" . mysqli_connect_errno() . ")";
            exit($msg);
        }
    }

    public function confirm_result_set($result_set)
    {
        if (!$result_set) {
            exit("Database query failed.");
        }
    }
}