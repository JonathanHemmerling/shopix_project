<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

interface NotFoundControllInterface
{
    public function renderView(): void;
}