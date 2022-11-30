<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Dto\ProductsDataTransferObject;

class ProductsMapper implements ProductsMapperInterface
{
    public function mapToProductsDto(array $product): ProductsDataTransferObject
    {
        return new ProductsDataTransferObject(
            $product['displayName'],
            $product['productDescription'],
            $product['price']
        );
    }
}