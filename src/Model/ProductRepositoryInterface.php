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
    public function getAllMainCategorys(): array;

    /**
     * @param int $subId
     * @return ProductsDataTransferObject
     */
    public function getAllProducts(): array;

    public function getProductByMainId(int $mainId): array;
    public function createNewProduct(
        int $mainId,
        string $displayName,
        string $productName,
        string $description,
        string $price
    ): void;

    public function getProductByProductId(int $productId): ProductsDataTransferObject;

    public function editProductById(int $productId, string $column, string $stringToChange): void;

    public function deleteProductById(int $productId): void;


}