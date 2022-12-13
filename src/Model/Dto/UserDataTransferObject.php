<?php

declare(strict_types=1);

namespace App\Model\Dto;

class UserDataTransferObject
{
    public function __construct(
        public readonly int $id,
        public readonly string $userName,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $country,
        public readonly string $postcode,
        public readonly string $city,
        public readonly string $street,
        public readonly string $streetNumber,
        public readonly string $email,
        public readonly string $telefonNumber,
        public readonly string $hashedPassword,
    ) {
    }
}
