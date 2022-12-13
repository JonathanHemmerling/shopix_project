<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Dto\MainMenuDataTransferObject;
use App\Model\Dto\ProductsDataTransferObject;

interface ProductRepositoryInterface
{
    /**
     * @param int $mainId
     * @return MainMenuDataTransferObject[]
     */
    public function getAllMainCategorysFromDatabase(): array;

    public function getMainCategorysByIdFromDatabase(int $mainId): ProductsDataTransferObject;

    /**
     * @param int $subId
     * @return ProductsDataTransferObject
     */
    public function getAllProductsFromDatabase(): array;

    public function getProductByMainIdFromDatabase(int $mainId): array;

    public function getProductByProductIdFromDatabase(int $productId): ProductsDataTransferObject;

    public function getProductByProductNameFromDatabase(string $productName): ProductsDataTransferObject;

    public function editProductByName(int $productId, string $column, string $stringToChange): bool;

    public function deleteProductById(int $productId): bool;
    public function createNewProduct(int $mainId, string $displayName,string $productName, string $description,string $price):bool;
}