<?php

declare(strict_types=1);

namespace App\Model\Dto;

class ProductsDataTransferObject
{
    public function __construct(
        public readonly string $displayName,
        public readonly string $productDescription,
        public readonly string $price,
    ) {
    }
}
