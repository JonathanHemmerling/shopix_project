<?php

declare(strict_types=1);

namespace App\Model;

use InvalidArgumentException;

class UserRepository
{
    private string $message = '';
    private string $constructedPathToJsonFile;
    private string $pathToJsonFile;
    private string $fileName;
    private const path = __DIR__ . '/../jsons/';

    public function __construct(string $fileName, string $pathToJsonFile = self::path)
    {
        $this->fileName = $fileName;
        $this->pathToJsonFile = $pathToJsonFile;
    }

    private function setConstructedPath(string $path): void
    {
        $this->constructedPathToJsonFile = $path;
        if (!file_exists($this->constructedPathToJsonFile)) {
            throw new InvalidArgumentException(sprintf('Path %s does not exist.', $this->constructedPathToJsonFile));
        }
    }

    public function getErrors(): string
    {
        return $this->message;
    }

    public function getCurrentUserData(): array
    {
        $this->setConstructedPath($this->pathToJsonFile . $this->fileName . '.json');
        if (file_exists($this->constructedPathToJsonFile)) {
            $currentData = file_get_contents($this->constructedPathToJsonFile);
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
        file_put_contents($this->constructedPathToJsonFile, $finalData);
    }
}