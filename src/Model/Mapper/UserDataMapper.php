<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use App\Model\Dto\UserDataTransferObject;

class UserDataMapper implements UserDataMapperInterface
{
    public function mapToUserDto(array $list): UserDataTransferObject
    {
        return new UserDataTransferObject(
            $list['id'],
            $list['userName'],
            $list['firstName'],
            $list['lastName'],
            $list['country'],
            $list['postcode'],
            $list['city'],
            $list['street'],
            $list['streetNumber'],
            $list['email'],
            $list['telefonNumber'],
            $list['hashedPassword'],
        );
    }

}