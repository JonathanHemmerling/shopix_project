<?php

declare(strict_types=1);

namespace App\Model\Dto;

class ListDataTransferObject
{
    public function __construct(
        public readonly int|null $categoryId,
        public readonly int|null $id,
        public readonly string $detail,
        public readonly string $displayName,
    ) {
    }
}
