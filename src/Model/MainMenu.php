<?php

namespace src\Model;

class MainMenu
{
    public function getMenuCategorysFromJson($fileName)
    {
        $jsonFile = file_get_contents(__DIR__ . '/../jsons/' . $fileName . '.json');
        $mainMenuContent = json_decode($jsonFile, JSON_OBJECT_AS_ARRAY);
        return $mainMenuContent;
    }
}
