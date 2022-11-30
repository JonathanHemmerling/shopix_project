<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Dto\ProductsDataTransferObject;

interface ProductRepositoryInterface
{
    public function getAllDataFromMainTable(): array;

    public function getAllDataFromSubCategorys(int $mainId): array;

    public function getAllDataFromProducts($subId): ProductsDataTransferObject;
}