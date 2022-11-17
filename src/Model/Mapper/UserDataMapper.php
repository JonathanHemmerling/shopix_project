<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Dto\UserDataTransferObject;

class UserDataMapper
{
    public function mapToUserDto(array $list): UserDataTransferObject
    {
        return new UserDataTransferObject(
            $list['userId'],
            $list['userName'],
            $list['password'],
        );
    }

}