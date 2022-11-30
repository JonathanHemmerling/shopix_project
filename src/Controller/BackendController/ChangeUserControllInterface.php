<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

interface ChangeUserControllInterface
{
    public function getUserDataSet(): array;

    public function changeUserData();

    public function renderView(): void;
}