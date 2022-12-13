<?php

declare(strict_types=1);

namespace App\Model\Dto;

class ProductsDataTransferObject
{
    public function __construct(
        public readonly int $productId,
        public readonly int $mainId,
        public readonly string $displayName,
        public readonly string $productName,
        public readonly string $description,
        public readonly string $price,
    ) {
    }
}
