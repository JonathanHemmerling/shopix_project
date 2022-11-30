<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

interface AdminControllerInterface
{
    public function renderView(): void;
}