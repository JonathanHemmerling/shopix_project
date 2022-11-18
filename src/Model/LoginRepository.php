<?php

declare(strict_types=1);

namespace App\Model;


use App\Model\Mapper\UserDataMapper;
use InvalidArgumentException;
use JsonException;
use RuntimeException;

class LoginRepository
{
    private string $constructedPathToJsonFile;
    private UserDataMapper $userDataMapper;
    private const depth = 512;
    private array $userArray = [];
    private string $fileName;
    private string $pathToJsonFile;
    private const path = __DIR__ . '/../jsons/';

    public function __construct(
        string $fileName,
        UserDataMapper $userDataMapper = new UserDataMapper(),
        string $pathToJsonFile = self::path
    ) {
        $this->userDataMapper = $userDataMapper;
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

    public function getAllDataFromJson(): array
    {
        $this->setConstructedPath($this->pathToJsonFile . $this->fileName . '.json');
        $jsonFile = file_get_contents($this->constructedPathToJsonFile);
        try {
            $allData = json_decode($jsonFile, true, self::depth, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new RuntimeException(
                sprintf('Invalid JSON stored in file "%s".', $this->constructedPathToJsonFile),
                0,
                $exception
            );
        }
        return $allData;
    }

    public function findUserByName(string $userName): array
    {
        $allData = $this->getAllDataFromJson();
        foreach ($allData as $dataSet) {
            if ($dataSet['userName'] === $userName) {
                $this->userArray = (array)$this->userDataMapper->mapToUserDto($dataSet);
            }
        }
        return $this->userArray;
    }
}