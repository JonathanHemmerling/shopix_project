<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Dto\UserDataTransferObject;

interface UserRepositoryInterface
{

    public function getAllUsers(): array;

    public function getCurrentUserDataById(int $id): UserDataTransferObject|null;

    public function editUserAttributeById(
        int $id,
        string $column,
        string $stringToChange
    ): void;

    public function doesUserDataExists(string $user): bool;

    public function addNewUserDataArrayToDb(array $userData): void;
}