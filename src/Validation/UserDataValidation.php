<?php

declare(strict_types=1);

namespace App\Validation;

use App\Model\LoginRepositoryInterface;
use App\Model\UserRepositoryInterface;

use function PHPUnit\Framework\isEmpty;

class UserDataValidation implements UserDataValidationInterface
{
    private array $errors = [];

    public function __construct(
        private readonly LoginRepositoryInterface $login,
        private readonly UserRepositoryInterface $repository
    ) {
    }

    public function checkIfNewUserNameIsValid(string $userName): bool
    {
        if ($userName === '') {
            $this->errors[] = 'Username cannot be blank';
            return false;
        }
        if (!$this->hasLength($userName)) {
            $this->errors[] = 'Username must be between 3 and 20 characters long';
            return false;
        }
        if (!$this->isAUniqueUserName($userName)) {
            $this->errors[] = 'Select another Username';
            return false;
        }
        return true;
    }

    public function checkIfUserNameIsValid(
        string $userName
    ): bool {
        if ($userName === '' || ((!$this->userExist($userName)))) {
            $this->errors = [];
            $this->errors[] = 'Invalid Userdata!';
            return false;
        }
        return true;
    }

    public function verifyPassword(
        string $userPassword,
        string $dbUserPassword
    ): bool {
        $passwordVerified = password_verify($userPassword, $dbUserPassword);
        if (!$passwordVerified) {
            $this->errors = [];
            $this->errors[] = 'Invalid Userdata!';
        }
        return $passwordVerified;
    }

    public function checkIfPasswordIsValid(string $password, string $confirmPassword): bool
    {
        if ($password === '') {
        $this->errors[] = 'Password cannot be blank';
        return false;
    }
        if ($confirmPassword === '') {
        $this->errors[] = 'Confirmpassword cannot be blank';
        return false;
    }
        if (strlen($confirmPassword) < 8) {
            $this->errors[] = 'Password must be at least 8 characters long';
            return false;
        }
        if (!password_verify($confirmPassword, $password)) {
            $this->errors[] = 'Passwords has to be the same';
            return false;
        }
        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function hasLengthGreaterThan(
        string $value,
        int $min
    ): bool {
        $length = strlen($value);
        return $length > $min;
    }

    private function hasLengthLessThan(
        string $value,
        int $max
    ): bool {
        $length = strlen($value);
        return $length < $max;
    }

    private function hasLength(
        string $value
    ): bool {
        $options = ['min' => 3, 'max' => 20];
        if (!$this->hasLengthGreaterThan($value, $options['min'] - 1)) {
            return false;
        }
        if (!$this->hasLengthLessThan($value, ($options['max'] + 1))) {
            return false;
        }
        return true;
    }

    private function isAUniqueUserName(string $userName): bool
    {
        $userDataDontExist = false;
        $userDataExist = $this->repository->doesUserDataExists($userName);
        if (!$userDataExist) {
            $userDataDontExist = true;
        }
        return $userDataDontExist;
    }

    private function userExist(
        string $value
    ): bool {
        $userDataExist = false;
        $adminDataArray = $this->login->findAdminByName($value);
        $userDataArray = $this->login->findUserByName($value);
        if ((isset($userDataArray['userName']) && $userDataArray['userName'] === $value) || (isset($adminDataArray['userName']) && $adminDataArray['userName'] === $value)) {
            $userDataExist = true;
        }
        return $userDataExist;
    }
}