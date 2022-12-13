<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Dto\MainMenuDataTransferObject;

class MainMenuMapper implements MainMenuMapperInterface
{
    public function mapToMainDto(array $list): MainMenuDataTransferObject
    {
        return new MainMenuDataTransferObject(
            $list['mainId'],
            $list['mainName'],
            $list['displayName'],
        );
    }

}