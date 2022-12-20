<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Dto\UserDataTransferObject;

interface UserDataMapperInterface
{
    public function mapToUserDto(array $list): UserDataTransferObject;
}