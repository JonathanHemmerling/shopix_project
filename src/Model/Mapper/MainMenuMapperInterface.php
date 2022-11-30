<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Dto\MainMenuDataTransferObject;

interface MainMenuMapperInterface
{
    public function mapToMainDto(array $list): MainMenuDataTransferObject;
}