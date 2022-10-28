<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use app\Model\Dto\ProductsDataTransferObject;

class ProductsMapper
{
    public function mapToDto(array $product): ProductsDataTransferObject
    {
        $productArray = $product;
        $productsDataObject = new ProductsDataTransferObject();
        $productsDataObject->setCategory();
        $productsDataObject->setCategoryDisplayName();
        $productsDataObject->setCategoryId();
        $productsDataObject->setDescription();
        $productsDataObject->setDetail();
        $productsDataObject->setProductDisplayName();
        $productsDataObject->setProductId();

        return $productsDataObject;
    }
}