<?php

declare(strict_types=1);

namespace App\Model;


use App\Model\Dto\MainMenuDataTransferObject;
use App\Model\Dto\ProductsDataTransferObject;
use App\Model\Mapper\MainMenuMapperInterface;
use App\Model\Mapper\ProductsMapperInterface;
use App\SQL\SqlConnectionInterface;
use PDO;

class ProductRepository implements ProductRepositoryInterface
{

    public function __construct(
        private readonly SqlConnectionInterface $dbConnection,
        private PDO $pdo,
        private readonly ProductsMapperInterface $productsMapper,
        private readonly MainMenuMapperInterface $mainMapper
    ) {
        $this->pdo = $this->dbConnection->connectToDatabase('0.0.0.0', 'shopix', 'TestUser', 'password', '13306');
    }

    //MainMenu

    /**
     * @param int $mainId
     * @return MainMenuDataTransferObject[]
     */
    public function getAllMainCategorys(): array|null
    {
        $queryString = "SELECT * FROM mainCategorys";
        $rows = $this->pdo->query($queryString);
        foreach ($rows as $row) {
            $dto [] = ($this->mainMapper->mapToMainDto($row));
        }
        return $dto ?? null;
    }

    //ProductsTable

    /**
     * @param int $subId
     * @return ProductsDataTransferObject
     */
    public function getAllProducts(): array|null
    {
        $queryString = "SELECT * FROM products";
        $rows = $this->pdo->query($queryString);
        foreach ($rows as $row) {
            $dto [] = ($this->productsMapper->mapToProductsDto($row));
        }
        return $dto ?? null;
    }

    public function getProductByMainId(int $mainId): array|null
    {
        $queryString = "SELECT * FROM products ";
        $queryString .= "WHERE mainId =" . $mainId;
        $queryString .= " ORDER BY displayName ASC";
        foreach ($this->pdo->query($queryString) as $row) {
            $dto [] = $this->productsMapper->mapToProductsDto($row);
        }
        return $dto ?? null;
    }

    public function getProductByProductId(int $productId): ProductsDataTransferObject|null
    {
        $queryString = "SELECT * FROM products ";
        $queryString .= "WHERE productId =" . $productId;
        foreach ($this->pdo->query($queryString) as $row) {
            $dto = $this->productsMapper->mapToProductsDto($row);
        }
        return $dto ?? null;
    }

    public function editProductById(int $productId, string $column, string $stringToChange): void
    {
        $queryString = "UPDATE products SET " . $column . "='" . $stringToChange . "' ";
        $queryString .= "WHERE productid=" . $productId;
        $this->pdo->query($queryString);
    }

    public function deleteProductById(int $productId): void
    {
        $queryString = "DELETE FROM products ";
        $queryString .= "WHERE productId =" . $productId;
        $this->pdo->query($queryString);
    }

    public function createNewProduct(
        int $mainId,
        string $displayName,
        string $productName,
        string $description,
        string $price
    ): void {
        $queryString = "INSERT INTO products (mainId, displayName, productName, description, price) VALUES (" . $mainId . ", '" . $displayName . "', '" . $productName . "', '" . $description . "', '" . $price . "')";
        $this->pdo->query($queryString);
    }

}