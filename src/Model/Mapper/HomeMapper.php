<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Dto\HomeDataTransferObject;
use App\Model\Dto\ListDataTransferObject;
use App\Model\Dto\ProductsDataTransferObject;

class HomeMapper
{
    public function mapToHomeDto(array $home): HomeDataTransferObject
    {
        return new HomeDataTransferObject(
            $home['id'],
            $home['category'],
            $home['displayName'],
        );
    }
}