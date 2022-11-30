<?php

declare(strict_types=1);

namespace App\Validation;

interface UserDataValidationInterface
{
    public function checkIfUserNameIsValid(string $userName): bool;

    public function verifyPassword(string $userPassword, string $dbUserPassword): bool;

    public function getErrors(): array;
}