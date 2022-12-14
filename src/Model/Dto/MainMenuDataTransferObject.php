<?php

declare(strict_types=1);

namespace App\Model\Dto;

class MainMenuDataTransferObject
{
    public function __construct(
        public readonly int|null $mainId,
        public readonly string $mainName,
        public readonly string $displayName,
    ) {
    }
}
