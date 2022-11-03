<?php

declare(strict_types=1);

namespace App\Service;
use App\Model\MainMenu;
use App\Model\Products;

class ModelProvider
{
    public function getList(): array
    {
        return [
            MainMenu::class,
            Products::class,
        ];
    }

    public function getClassByString(string $pageTitle): string
    {
        return 'App\Controller\\' . $pageTitle . 'Controll';
    }
}