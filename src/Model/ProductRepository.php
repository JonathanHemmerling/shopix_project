<?php

declare(strict_types=1);

namespace App\Model;

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
    private ListMapper $listMapper;
    private const depth = 512;
    private ProductsMapper $productsMapper;

    public function __construct(string $fileName, ListMapper $listMapper = new ListMapper(), ProductsMapper $productsMapper = new ProductsMapper(), string $pathToJsonFile = __DIR__ . '/../jsons/')
    {
        $this->listMapper = $listMapper;
        $this->productsMapper = $productsMapper;
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
            $this->setJsonFileContent(json_decode($jsonFile, true, self::depth , JSON_THROW_ON_ERROR));
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
        $allData = $this->getJsonFileContent();
        foreach ($allData as $dataSet) {
            if ($dataSet['categoryId'] === $categoryId && $dataSet['id'] === $id) {
                $pdto = $this->productsMapper->mapToProductsDto($dataSet);
            }
        }
       return $pdto;
    }

    public function findCategoryById(int $categoryId): array
    {
        $allData = $this->getJsonFileContent();
        $listCategory = [];
        foreach ($allData as $dataSet) {
            if ($dataSet['categoryId'] === $categoryId) {
                $listCategory[] = (array)$this->listMapper->mapToListDto($dataSet);
            }
        }

        $stringArray = [];
        foreach ($listCategory as $categoryElement) {
            $categoryArray = [];
            $categoryArray[] = $categoryElement['categoryId'];
            $categoryArray[] = $categoryElement['id'];
            $categoryArray[] = $categoryElement['detail'];
            $categoryArray[] = $categoryElement['displayName'];
            $stringArray[] = 'index.php?page=Detail&' . $categoryArray[2] . '&categoryId=' . $categoryArray[0] . '&id=' . $categoryArray[1] . '>' . $categoryArray[3];
        }
       return $stringArray;
    }

}