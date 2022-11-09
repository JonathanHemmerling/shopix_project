<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Dto\ListDataTransferObject;
use App\Model\Dto\ProductsDataTransferObject;
use App\Model\Mapper\ListMapper;
use App\Model\Mapper\ProductsMapper;
use InvalidArgumentException;
use JsonException;
use RuntimeException;

class ProductRepository
{
    private string $constructedPathToJsonFile;
    private array $jsonFileContent;
    private ProductsMapper $productsMapper;

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

    public function findProductById(int $categoryId, int $id): ProductsDataTransferObject
    {
        $this->productsMapper = new ProductsMapper();
        $allData = $this->getJsonFileContent();
        foreach($allData as $dataSet){
           if($dataSet['categoryId'] === $categoryId && $dataSet['id'] === $id){
               $pdto = $this->productsMapper->mapToProductsDto($dataSet);
           }
        }
        return $pdto;
    }

    public function findCategoryById(int $categoryId): array
    {
        $this->listMapper = new ListMapper();
        $allData = $this->getJsonFileContent();
        $catgoryArray = [];
        foreach ($allData as $dataSet) {
            if ($dataSet['categoryId'] === $categoryId) {
                $catgoryArray[] = $this->listMapper->mapToListDto($dataSet);
            }
        }
        return $catgoryArray;
    }

}