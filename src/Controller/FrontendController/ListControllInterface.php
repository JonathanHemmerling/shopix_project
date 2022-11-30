<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

interface ListControllInterface
{
    public function getStrForLinks(): array;

    public function setStrForLinks(string $strForLinks): void;

    public function renderView(): void;
}