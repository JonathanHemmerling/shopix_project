<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

interface LoginControllInterface
{
    //public function getLoginData(string $userName): void;

    //public function getUserDataSet(string $userName): array;

    public function renderView(): void;
}