<?php

declare(strict_types=1);

namespace App\Model;

class Products
{
    public function getProductsFromJson(): array
    {
        $jsonFile = file_get_contents(__DIR__ . '/../jsons/products.json');
        return json_decode($jsonFile, true);
    }
}
