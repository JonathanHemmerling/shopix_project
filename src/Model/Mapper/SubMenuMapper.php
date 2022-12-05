<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Dto\SubMenuDataTransferObject;

class SubMenuMapper implements SubMenuMapperInterface
{
    public function mapToListDto(array $list): SubMenuDataTransferObject
    {
        return new SubMenuDataTransferObject(
            $list['subId'],
            $list['productNames'],
            $list['displayName'],
        );
    }

}