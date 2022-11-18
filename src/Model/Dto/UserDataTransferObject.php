<?php

declare(strict_types=1);

namespace App\Model\Dto;

class UserDataTransferObject
{
    public function __construct(
        public readonly string $userName,
        public readonly string $password,
    ) {
    }
}
