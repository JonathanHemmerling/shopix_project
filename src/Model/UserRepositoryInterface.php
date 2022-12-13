<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Dto\UserDataTransferObject;

interface UserRepositoryInterface
{

    public function getAllUsersFromDatabase(): array;

    public function getCurrentUserData(string $user): UserDataTransferObject;

    public function changeUserAttributeByAttribiute(string $attribute, string $field, string $userName, string $dbName): bool;

    public function doesUserDataExists(string $user): bool;

    public function addNewUserDataArrayToDb(array $userData): void;

    public function changeUserDataByUserId(int $userId, array $userDataSet): void;

    public function changeUserDataByUserName(array $userData, string $userName): void;
}