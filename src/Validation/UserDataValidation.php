<?php

declare(strict_types=1);

namespace App\Validation;

use App\Model\LoginRepository;

class UserDataValidation
{
    private LoginRepository $repository;
    private array $errors = [];

    public function __construct(
        LoginRepository $repository = new LoginRepository('Login')
    ) {
        $this->repository = $repository;
    }

    private function is_blank(string $value): bool
    {
        return !isset($value) || trim($value) === '';
    }

    private function userNameExist(string $value): bool
    {
        $userDataExist = false;
        $userDataArray = $this->repository->getAllDataFromJson();
        foreach ($userDataArray as $dataSet) {
            if ($dataSet['userName'] === $value) {
                $userDataExist = true;
            }
        }
        return $userDataExist;
    }

    public function checkIfUserNameIsValid(string $userName): bool
    {
        $userNameValid = true;
        if ($this->is_blank($userName) || !$this->userNameExist($userName)) {
            $this->errors = [];
            $this->errors[] = 'Invalid Userdata!';
            $userNameValid = false;
        }
        return $userNameValid;
    }

    public function verifyPassword(string $userPassword, string $dbUserPassword): bool
    {
        $passwordVerified = password_verify($userPassword, $dbUserPassword);
        if (!$passwordVerified) {
            $this->errors = [];
            $this->errors[] = 'Invalid Userdata!';
        }
        return $passwordVerified;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}