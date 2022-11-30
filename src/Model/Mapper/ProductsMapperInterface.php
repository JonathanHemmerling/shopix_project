<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Dto\ProductsDataTransferObject;

interface ProductsMapperInterface
{
    public function mapToProductsDto(array $product): ProductsDataTransferObject;
}