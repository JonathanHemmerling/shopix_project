<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

interface HomeControllInterface
{
    public function getStrForLinks(): array;

    public function renderView(): void;
}