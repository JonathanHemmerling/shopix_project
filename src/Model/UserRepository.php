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

    public function __construct(private SqlConnectionInterface $dbConnection, private UserDataMapper $userDataMapper)
    {
        $this->pdo = $this->dbConnection->connectToDatabase('0.0.0.0', 'shopix', 'TestUser', 'password', '13306');
    }

    public function getAllUsersFromDatabase(): array
    {

        $queryString = "SELECT * FROM userData";
        foreach ($this->pdo->query($queryString) as $row) {
            $dataArray [] = $this->userDataMapper->mapToUserDto($row);
        }
        return $dataArray;
    }

    public function getCurrentUserData(string $user): UserDataTransferObject
    {
        $queryString = "SELECT * FROM userData WHERE ";
        $queryString .= "userName=\"" . $user . '";';
        foreach ($this->pdo->query($queryString) as $row) {
            $dataArray = $this->userDataMapper->mapToUserDTO($row);
        }
        return $dataArray;
    }

    public function doesUserDataExists(string $user): bool
    {
        $exists = false;
        $queryString = "SELECT * FROM userData WHERE ";
        $queryString .= "userName=\"" . $user . '";';
        foreach ($this->pdo->query($queryString) as $row) {
            $exists = true;
        }
        return $exists;
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

    public function changeUserAttributeByAttribiute(
        string $attribute,
        string $field,
        string $userName,
        string $dbName
    ): bool {
        $booly = false;
        $queryString = "UPDATE userData SET ";
        $queryString .= $field . "='" . $attribute . "' ";
        $queryString .= "WHERE userName='" . $dbName . "' AND " . $field . "='" . $userName . "'";
        $this->pdo->query($queryString);
        $controll = $this->getCurrentUserData($dbName);
        if ($controll->$field === $attribute) {
            $booly = true;
        }
        return $booly;
    }

    public function changeUserDataByUserId(int $userId, array $userDataSet): void
    {
        $queryString = "UPDATE userData SET ";
        $queryString .= "userName=\"" . $userDataSet['userName'] . '",';
        $queryString .= "firstName=\"" . $userDataSet['firstName'] . '",';
        $queryString .= "lastName=\"" . $userDataSet['lastName'] . '",';
        $queryString .= "country=\"" . $userDataSet['country'] . '",';
        $queryString .= "postcode=\"" . $userDataSet['postCode'] . '",';
        $queryString .= "city=\"" . $userDataSet['city'] . '",';
        $queryString .= "street=\"" . $userDataSet['street'] . '",';
        $queryString .= "streetNumber=\"" . $userDataSet['streetNumber'] . '",';
        $queryString .= "email=\"" . $userDataSet['email'] . '",';
        $queryString .= "telefonNumber=\"" . $userDataSet['telefonNumber'] . '",';
        $queryString .= "hashedPassword=\"" . $userDataSet['hashedPassword'] . ' "';
        $queryString .= "WHERE id=" . $userId . ';';
        $this->pdo->query($queryString);
    }
    public function changeUserDataByUserName(array $userDataSet, string $userName): void
    {
        $queryString = "UPDATE userData SET ";
        $queryString .= "userName=\"" . $userDataSet['userName'] . '",';
        $queryString .= "firstName=\"" . $userDataSet['firstName'] . '",';
        $queryString .= "lastName=\"" . $userDataSet['lastName'] . '",';
        $queryString .= "country=\"" . $userDataSet['country'] . '",';
        $queryString .= "postcode=\"" . $userDataSet['postCode'] . '",';
        $queryString .= "city=\"" . $userDataSet['city'] . '",';
        $queryString .= "street=\"" . $userDataSet['street'] . '",';
        $queryString .= "streetNumber=\"" . $userDataSet['streetNumber'] . '",';
        $queryString .= "email=\"" . $userDataSet['email'] . '",';
        $queryString .= "telefonNumber=\"" . $userDataSet['telefonNumber'] . '",';
        $queryString .= "hashedPassword=\"" . $userDataSet['hashedPassword'] . ' "';
        $queryString .= "WHERE userName=\"" . $userName . '";';
        $this->pdo->query($queryString);
    }
}