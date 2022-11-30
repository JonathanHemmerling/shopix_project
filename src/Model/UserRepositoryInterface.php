<?php

declare(strict_types=1);

namespace App\Model;

interface UserRepositoryInterface
{
    public function getErrors(): string;

    public function getCurrentUserData(string $user): array;

    public function addNewUserDataArrayToDb(array $userData): void;

    public function changeUserDataArrayFromDb(array $userData, string $userName): void;
}