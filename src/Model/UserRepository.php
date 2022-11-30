<?php

declare(strict_types=1);

namespace App\Model;

use App\SQL\SqlConnectionInterface;
use PDO;

class UserRepository implements UserRepositoryInterface
{
    private string $message = '';
    private PDO $pdo;
    private array $dataArray = [];

    public function __construct(private SqlConnectionInterface $dbConnection)
    {
        $this->pdo = $this->dbConnection->connectToDatabase('0.0.0.0', 'shopix', 'TestUser', 'password', '13306');
    }


    public function getErrors(): string
    {
        return $this->message;
    }

    public function getCurrentUserData(string $user): array
    {
        $string = "SELECT * FROM userData WHERE ";
        $string .= "userName=\"" . $user . '";';
        foreach ($this->pdo->query($string) as $row) {
            $this->dataArray = $row;
        }
        return $this->dataArray;
    }

    public function addNewUserDataArrayToDb(array $userData): void
    {
        $string = "INSERT INTO userData ";
        $string .= "(userName, firstName, lastName, country, postcode, city, street, streetNumber, email, telefonNumber, hashedPassword) ";
        $string .= "VALUES ('" . $userData['userName'] . "', ";
        $string .= "'" . $userData['firstName'] . "', ";
        $string .= "'" . $userData['lastName'] . "', ";
        $string .= "'" . $userData['country'] . "', ";
        $string .= "'" . $userData['postCode'] . "', ";
        $string .= "'" . $userData['city'] . "', ";
        $string .= "'" . $userData['street'] . "', ";
        $string .= "'" . $userData['streetNumber'] . "', ";
        $string .= "'" . $userData['email'] . "', ";
        $string .= "'" . $userData['telefonNumber'] . "', ";
        $string .= "'" . $userData['hashedPassword'] . "');";
        $this->pdo->query($string);
    }

    public function changeUserDataArrayFromDb(array $userData, string $userName): void
    {
        $string = "UPDATE userData SET ";
        $string .= "userName=\"" . $userData['userName'] . '",';
        $string .= "firstName=\"" . $userData['firstName'] . '",';
        $string .= "lastName=\"" . $userData['lastName'] . '",';
        $string .= "country=\"" . $userData['country'] . '",';
        $string .= "postcode=\"" . $userData['postCode'] . '",';
        $string .= "city=\"" . $userData['city'] . '",';
        $string .= "street=\"" . $userData['street'] . '",';
        $string .= "streetNumber=\"" . $userData['streetNumber'] . '",';
        $string .= "email=\"" . $userData['email'] . '",';
        $string .= "telefonNumber=\"" . $userData['telefonNumber'] . '",';
        $string .= "hashedPassword=\"" . $userData['hashedPassword'] . ' "';
        $string .= "WHERE userName=\"" . $userName . '";';
        $this->pdo->query($string);
    }
}