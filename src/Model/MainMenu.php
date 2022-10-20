<?php

declare(strict_types=1);

namespace App\Model;

class MainMenu
{
    public function getMenuCategorysFromJson(): array
    {
        $jsonFile = file_get_contents(__DIR__ . '/../jsons/menuCategorys.json');
        $mainMenuContent = json_decode($jsonFile, true);
        return $mainMenuContent;
    }
}
