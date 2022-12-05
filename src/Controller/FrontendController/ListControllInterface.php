<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

interface ListControllInterface
{
    public function getStrForLinks(): array;

    public function renderView(): void;
}