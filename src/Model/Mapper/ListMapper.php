<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Dto\HomeDataTransferObject;
use App\Model\Dto\ListDataTransferObject;
use App\Model\Dto\ProductsDataTransferObject;

class ListMapper
{
    public function mapToListDto(array $list): ListDataTransferObject
    {
        return new ListDataTransferObject(
            $list['categoryId'],
            $list['id'],
            $list['detail'],
            $list['displayName']
        );
    }

}