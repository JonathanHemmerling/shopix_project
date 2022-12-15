<?php

declare(strict_types=1);

namespace App\Model;

use App\SQL\SqlConnection;
use PDO;


class LoginRepository implements LoginRepositoryInterface
{
    private array $userArray = [];

    public function __construct(private readonly SqlConnection $dbConnection, private PDO $pdo)
    {
        $this->pdo = $this->dbConnection->connectToDatabase('0.0.0.0', 'shopix', 'TestUser', 'password', '13306');
    }

    public function findAdminByName(string $userName): array
    {
        $string = "SELECT * FROM admin WHERE userName = ";
        $string .= '"' . $userName . '"';
        foreach ($this->pdo->query($string) as $row) {
            $this->userArray = $row;
        }
        return $this->userArray;
    }

    public function findUserByName(string $userName): array
    {
        $string = "SELECT * FROM userData WHERE userName = ";
        $string .= '"' . $userName . '"';
        foreach ($this->pdo->query($string) as $row) {
            $this->userArray = $row;
        }
        return $this->userArray;
    }
}