<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

interface UserControllInterface
{
    public function validateLoginData(): array;

    public function renderView(): void;
}