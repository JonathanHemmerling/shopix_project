<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Dto\SubMenuDataTransferObject;

interface SubMenuMapperInterface
{
    public function mapToListDto(array $list): SubMenuDataTransferObject;
}