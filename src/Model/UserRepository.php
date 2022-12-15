<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Dto\UserDataTransferObject;
use App\Model\Mapper\UserDataMapper;
use App\SQL\SqlConnectionInterface;
use PDO;

class UserRepository implements UserRepositoryInterface
{
    private PDO $pdo;

    public function __construct(private readonly SqlConnectionInterface $dbConnection, private readonly UserDataMapper $userDataMapper)
    {
        $this->pdo = $this->dbConnection->connectToDatabase('0.0.0.0', 'shopix', 'TestUser', 'password', '13306');
    }

    public function getAllUsers(): array
    {
        $queryString = "SELECT * FROM userData";
        foreach ($this->pdo->query($queryString) as $row) {
            $dataArray [] = $this->userDataMapper->mapToUserDto($row);
        }
        return $dataArray;
    }

    public function getCurrentUserDataById(int $id): UserDataTransferObject
    {
        $queryString = "SELECT * FROM userData WHERE ";
        $queryString .= "id=" . $id . ';';
        foreach ($this->pdo->query($queryString) as $row) {
            $dataArray = $this->userDataMapper->mapToUserDTO($row);
        }
        return $dataArray;
    }

    public function doesUserDataExists(string $user): bool
    {
        $queryString = "SELECT * FROM userData WHERE ";
        $queryString .= "userName=\"" . $user . '";';
        foreach ($this->pdo->query($queryString) as $row) {
            $userArray = $this->userDataMapper->mapToUserDTO($row);
        }
        if (!$userArray) {
            return false;
        }
        return true;
    }

    public function addNewUserDataArrayToDb(array $userDataSet): void
    {
        $queryString = "INSERT INTO userData ";
        $queryString .= "(userName, firstName, lastName, country, postcode, city, street, streetNumber, email, telefonNumber, hashedPassword) ";
        $queryString .= "VALUES ('" . $userDataSet['userName'] . "', ";
        $queryString .= "'" . $userDataSet['firstName'] . "', ";
        $queryString .= "'" . $userDataSet['lastName'] . "', ";
        $queryString .= "'" . $userDataSet['country'] . "', ";
        $queryString .= "'" . $userDataSet['postCode'] . "', ";
        $queryString .= "'" . $userDataSet['city'] . "', ";
        $queryString .= "'" . $userDataSet['street'] . "', ";
        $queryString .= "'" . $userDataSet['streetNumber'] . "', ";
        $queryString .= "'" . $userDataSet['email'] . "', ";
        $queryString .= "'" . $userDataSet['telefonNumber'] . "', ";
        $queryString .= "'" . $userDataSet['hashedPassword'] . "');";
        $this->pdo->query($queryString);
    }

    public function editUserAttributeById(
        int $id,
        string $column,
        string $stringToChange,
    ): void {
        $queryString = "UPDATE userData SET " . $column . "='" . $stringToChange . "' ";
        $queryString .= "WHERE id=" . $id;
        $this->pdo->query($queryString);
    }

    public function deleteUserById(int $userId): void
    {
        $queryString = "DELETE FROM userData ";
        $queryString .= "WHERE id =" . $userId;
        $this->pdo->query($queryString);
    }
}