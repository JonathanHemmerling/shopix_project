<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Dto\ProductsDataTransferObject;

class ProductsMapper
{
    public function __construct()
    {
    }

    public function mapToDto(array $product): ProductsDataTransferObject
    {
        return new ProductsDataTransferObject(
            $product['categoryId'],
            $product['detail'],
            $product['name'],
            $product['description']
        );
    }
}