<?php

declare(strict_types=1);

namespace App\Model;

class NewUserRepository
{
    private string $filePath;

    public function __construct(string $fileName, string $pathToJsonFile = __DIR__ . '/../jsons/')
    {
        $this->filePath = $pathToJsonFile . $fileName . '.json';
    }

    public function addNewUserDataArrayToJson(array $userData): void
    {
        var_dump($this->filePath);
        var_dump($userData);
    }
}