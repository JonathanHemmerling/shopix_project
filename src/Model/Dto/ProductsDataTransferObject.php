<?php

declare(strict_types=1);

namespace App\Model\Dto;

class ProductsDataTransferObject
{
    public function __construct(
        public readonly int|null $categoryId,
        public readonly string $detail,
        public readonly string $name,
        public readonly string $description,
    )
    {
    }
}
