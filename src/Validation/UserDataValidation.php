<?php

declare(strict_types=1);

namespace App\Validation;

use App\Model\LoginRepositoryInterface;
use App\Model\UserRepositoryInterface;

class UserDataValidation implements UserDataValidationInterface
{
    private array $errors = [];

    public function __construct(
        private readonly LoginRepositoryInterface $login,
        private readonly UserRepositoryInterface $repository
    ) {
    }

    private function is_blank(
        string $value
    ): bool {
        return !isset($value) || trim($value) === '';
    }

    private function has_length_greater_than(
        string $value,
        int $min
    ): bool {
        $length = strlen($value);
        return $length > $min;
    }

    private function has_length_less_than(
        string $value,
        int $max
    ): bool {
        $length = strlen($value);
        return $length < $max;
    }

    private function has_length_exactly(
        $value,
        $exact
    ): bool {
        $length = strlen($value);
        return $length === $exact;
    }

    private function has_length(
        string $value,
        array $options
    ): bool {
        if (isset($options['min']) && !$this->has_length_greater_than($value, $options['min'] - 1)) {
            return false;
        }
        if (isset($options['max']) && !$this->has_length_less_than($value, $options['max'] + 1)) {
            return false;
        }

        if (isset($options['exact']) && !$this->has_length_exactly($value, $options['exact'])) {
            return false;
        } else {
            return true;
        }
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

    public function userNameExist(
        string $value
    ): bool {
        $userDataExist = false;
        $userDataArray = $this->login->findUserByName($value);
        if (isset($userDataArray['userName']) && $userDataArray['userName'] === $value) {
            $userDataExist = true;
        }
        return $userDataExist;
    }

    public function userAdminExist(
        string $value
    ): bool {
        $userDataExist = false;
        $userDataArray = $this->login->findAdminByName($value);
        if (isset($userDataArray['userName']) && $userDataArray['userName'] === $value) {
            $userDataExist = true;
        }
        return $userDataExist;
    }

    public function checkIfNewUserNameIsValid(string $userName): bool
    {
        $userNameValid = true;
        if ($this->is_blank($userName)) {
            $this->errors[] = 'Username cannot be blank';
            $userNameValid = false;
        } elseif (!$this->has_length($userName, ['min' => 3, 'max' => 20])) {
            $this->errors[] = 'Username must be between 3 and 20 characters long';
            $userNameValid = false;
        } elseif (!$this->isAUniqueUserName($userName)) {
            $this->errors[] = 'Select another Username';
            $userNameValid = false;
        }
        return $userNameValid;
    }

    public function checkIfUserNameIsValid(
        string $userName
    ): bool {
        $userNameValid = true;
        if ($this->is_blank($userName) || ((!$this->userNameExist($userName) && !$this->userAdminExist($userName)))) {
            $this->errors = [];
            $this->errors[] = 'Invalid Userdata!';
            $userNameValid = false;
        }
        return $userNameValid;
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

    public function checkIfPasswordIsValid(string $password, string $confirmPassword)
    {
        $passwordValid = true;
        if ($this->is_blank($password) || $this->is_blank($confirmPassword)) {
            $this->errors[] = 'Password cannot be blank';
            $passwordValid = false;
        }
        if (!$this->has_length($confirmPassword, ['min' => 8, 'max' => 40])) {
            $this->errors[] = 'Password must be between 8 and 40 characters long';
            $passwordValid = false;
        }
        if (!password_verify($confirmPassword, $password)) {
            $this->errors[] = 'Passwords has to be the same';
            $passwordValid = false;
        }
        return $passwordValid;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}