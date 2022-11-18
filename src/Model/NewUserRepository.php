<?php

declare(strict_types=1);

namespace App\Model;

class NewUserRepository
{
    private string $filePath;
    private string $message = '';

    public function __construct(string $fileName, string $pathToJsonFile = __DIR__ . '/../jsons/')
    {
        $this->filePath = $pathToJsonFile . $fileName . '.json';
    }

    public function getErrors(): string
    {
        return $this->message;
    }

    public function getCurrentUserData(): array
    {
        if (file_exists($this->filePath)) {
            $currentData = file_get_contents($this->filePath);
            $arrayData = json_decode($currentData, true);
        }
        return $arrayData;
    }

    public function addNewUserDataArrayToJson(array $userData): void
    {
            $arrayData = $this->getCurrentUserData();
            $newArrayData = $userData;
            $arrayData[] = $newArrayData;
            $finalData = json_encode($arrayData);
            file_put_contents($this->filePath, $finalData);
    }
}