<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

interface ChangeUserDataControllInterface
{
    public function getUserDataSet(): array;

    public function renderView(): void;
}