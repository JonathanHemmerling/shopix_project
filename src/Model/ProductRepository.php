<?php

declare(strict_types=1);

namespace App\Model;


use App\Model\Dto\MainMenuDataTransferObject;
use App\Model\Dto\ProductsDataTransferObject;
use App\Model\Mapper\MainMenuMapper;
use App\Model\Mapper\ProductsMapperInterface;
use App\SQL\SqlConnectionInterface;
use PDO;

class ProductRepository implements ProductRepositoryInterface
{

    public function __construct(
        private readonly SqlConnectionInterface $dbConnection,
        private PDO $pdo,
        private ProductsMapperInterface $productsMapper,
        private MainMenuMapper $mainMapper
    ) {
        $this->pdo = $this->dbConnection->connectToDatabase('0.0.0.0', 'shopix', 'TestUser', 'password', '13306');
    }

    //MainMenu

    /**
     * @param int $mainId
     * @return MainMenuDataTransferObject[]
     */
    public function getAllMainCategorysFromDatabase(): array
    {
        $queryString = "SELECT * FROM mainCategorys";
        $rows = $this->pdo->query($queryString);
        foreach ($rows as $row) {
            $dto [] = ($this->mainMapper->mapToMainDto($row));
        }
        return $dto;
    }

    public function getMainCategorysByIdFromDatabase(int $mainId): ProductsDataTransferObject
    {
        $queryString = "SELECT * FROM products ";
        $queryString .= "WHERE mainId =" . $mainId;
        foreach ($this->pdo->query($queryString) as $row) {
            $dto = $this->productsMapper->mapToProductsDto($row);
        }
        return $dto;
    }


    //ProductsTable

    /**
     * @param int $subId
     * @return ProductsDataTransferObject
     */
    public function getAllProductsFromDatabase(): array
    {
        $queryString = "SELECT * FROM products";
        $rows = $this->pdo->query($queryString);
        foreach ($rows as $row) {
            $dto [] = ($this->mainMapper->mapToMainDto($row));
        }
        return $dto;
    }

    public function getProductByMainIdFromDatabase(int $mainId): array
    {
        $queryString = "SELECT * FROM products ";
        $queryString .= "WHERE mainId =" . $mainId;
        $queryString .= " ORDER BY displayName ASC";
        foreach ($this->pdo->query($queryString) as $row) {
            $dto [] = $this->productsMapper->mapToProductsDto($row);
        }
        return $dto;
    }

    public function getProductByProductIdFromDatabase(int $productId): ProductsDataTransferObject
    {
        $queryString = "SELECT * FROM products ";
        $queryString .= "WHERE productId =" . $productId;
        foreach ($this->pdo->query($queryString) as $row) {
            $dto = $this->productsMapper->mapToProductsDto($row);
        }
        return $dto;
    }

    public function getProductByProductNameFromDatabase(string $productName): ProductsDataTransferObject
    {
        $queryString = "SELECT * FROM products ";
        $queryString .= "WHERE displayName ='" . $productName . "'";
        foreach ($this->pdo->query($queryString) as $row) {
            $dto = $this->productsMapper->mapToProductsDto($row);
        }
        return $dto;
    }

    public function editProductByName(int $productId, string $column, string $stringToChange): bool
    {
        $queryString = "UPDATE products SET " . $column . "='" . $stringToChange . "' ";
        $queryString .= "WHERE productid=" . $productId;
        $this->pdo->query($queryString);
        return true;
    }

    public function deleteProductById(int $productId): bool
    {
        $queryString = "DELETE FROM products ";
        $queryString .= "WHERE productId =" . $productId;
        $this->pdo->query($queryString);
        return true;
    }

    public function createNewProduct(
        int $mainId,
        string $displayName,
        string $productName,
        string $description,
        string $price
    ):bool
    {
        $queryString = "INSERT INTO products (mainId, displayName, productName, description, price) ";
        $queryString .= "VALUES (" . $mainId . ", '" . $displayName . "', '" . $productName . "', '" . $description . "', '" . $price . "')";
        var_dump($queryString);
        $this->pdo->query($queryString);
        return true;
    }

}