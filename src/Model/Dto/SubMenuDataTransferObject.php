<?php

declare(strict_types=1);

namespace App\Model\Dto;

class SubMenuDataTransferObject
{
    public function __construct(
        public readonly int|null $subId,
        public readonly string $productNames,
        public readonly string $displayName,
    ) {
    }
}
