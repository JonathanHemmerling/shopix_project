<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

interface DetailControllInterface
{
    public function setStrForProductName(array $strForProductName): void;

    public function getStrForProductName(): array;

    public function getStrForProductDescription(): array;

    public function renderView(): void;
}