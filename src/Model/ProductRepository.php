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
    private string $fileName;
    private string $pathToJsonFile;
    private const path = __DIR__ . '/../jsons/';

    public function __construct(
        string $fileName,
        ListMapper $listMapper = new ListMapper(),
        ProductsMapper $productsMapper = new ProductsMapper(),
        string $pathToJsonFile = self::path
    ) {
        $this->listMapper = $listMapper;
        $this->productsMapper = $productsMapper;
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

    public function findProductById(int $categoryId, int $id): ProductsDataTransferObject
    {
        $allData = $this->getAllDataFromJson();
        foreach ($allData as $dataSet) {
            if ($dataSet['categoryId'] === $categoryId && $dataSet['id'] === $id) {
                $pdto = $this->productsMapper->mapToProductsDto($dataSet);
            }
        }
        return $pdto;
    }

    public function findCategoryById(int $categoryId): array
    {
        $allData = $this->getAllDataFromJson();
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