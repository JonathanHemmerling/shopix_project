<?php

declare(strict_types=1);

namespace App\Model\Dto;

class HomeDataTransferObject
{
    public function __construct(
        public readonly int|null $id,
        public readonly string $category,
        public readonly string $displayName,
    ) {
    }
}
