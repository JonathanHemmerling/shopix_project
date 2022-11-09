<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Mapper\ProductsMapper;
use InvalidArgumentException;
use JsonException;
use RuntimeException;

class ProductRepository
{
    private string $constructedPathToJsonFile;
    private array $jsonFileContent;

    public function __construct(string $fileName, string $pathToJsonFile = __DIR__ . '/../jsons/')
    {
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

    public function getAllDataFromJson(): void
    {
        $jsonFile = file_get_contents($this->constructedPathToJsonFile);
        try {
            $this->setJsonFileContent(json_decode($jsonFile, true, 512, JSON_THROW_ON_ERROR));
        } catch (JsonException $exception) {
            throw new RuntimeException(
                sprintf('Invalid JSON stored in file "%s".', $this->constructedPathToJsonFile),
                0,
                $exception
            );
        }
    }

    public function findProductById(string $categoryId, string $id): array
    {
        $allDateOfOneEntry = [];
        $allData = $this->getJsonFileContent();
        foreach ($allData as $concreteRecord) {
            if ($concreteRecord['id'] === $id && $concreteRecord['categoryId'] === $categoryId) {
                $allDateOfOneEntry[] = $concreteRecord['id'];
                $allDateOfOneEntry[] = $concreteRecord['detail'];
                $allDateOfOneEntry[] = $concreteRecord['displayName'];
                $allDateOfOneEntry[] = $concreteRecord['description'];
            }
        }
        return $allDateOfOneEntry;
    }

    public function findCategoryById(string $categoryId): array
    {
        $allDateOfOneCategory = [];
        $allData = $this->getAllDataFromJson();
        foreach ($allData as $oneData) {
            if ($oneData['id'] === $categoryId) {
                $allDateOfOneCategory[] = $oneData['id'];
                $allDateOfOneCategory[] = $oneData['category'];
                $allDateOfOneCategory[] = $oneData['displayName'];
            }
        }
        return $allDateOfOneCategory;
    }

    public function giveDataToMapper()
    {
        $productArray = $this->findProductById();
        $categoryArray = $this->findCategoryById();
        $productMapper = new ProductsMapper;
        $productMapper->mapToDto($productArray);
    }
}