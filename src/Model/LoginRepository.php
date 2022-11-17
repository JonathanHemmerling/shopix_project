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
    private array $jsonFileContent;
    private UserDataMapper $userDataMapper;
    private const depth = 512;
    private array $userArray = [];

    public function __construct(
        string $fileName,
        UserDataMapper $userDataMapper = new UserDataMapper(),
        string $pathToJsonFile = __DIR__ . '/../jsons/'
    ) {
        $this->userDataMapper = $userDataMapper;
        $this->setConstructedPath($pathToJsonFile . $fileName . '.json');
        $this->getAllDataFromJson();
    }

    private function setConstructedPath(string $path): void
    {
        $this->constructedPathToJsonFile = $path;
        if (!file_exists($this->constructedPathToJsonFile)) {
            throw new InvalidArgumentException(sprintf('Path %s does not exist.', $this->constructedPathToJsonFile));
        }
    }

    private function setJsonFileContent(array $jsonFile): void
    {
        $this->jsonFileContent = $jsonFile;
    }

    public function getJsonFileContent(): array
    {
        return $this->jsonFileContent;
    }

    private function getAllDataFromJson(): void
    {
        $jsonFile = file_get_contents($this->constructedPathToJsonFile);
        try {
            $this->setJsonFileContent(json_decode($jsonFile, true, self::depth, JSON_THROW_ON_ERROR));
        } catch (JsonException $exception) {
            throw new RuntimeException(
                sprintf('Invalid JSON stored in file "%s".', $this->constructedPathToJsonFile),
                0,
                $exception
            );
        }
    }

    public function findUserByName(string $userName): array
    {
        $allData = $this->getJsonFileContent();
        foreach ($allData as $dataSet) {
            if ($dataSet['userName'] === $userName) {
                $this->userArray = (array)$this->userDataMapper->mapToUserDto($dataSet);
            }
        }
        return $this->userArray;
    }
}