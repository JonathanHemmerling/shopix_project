<?php

namespace src\Model;

class Category
{
    public function getCategorysFromJson($fileName)
    {
        $jsonFile = file_get_contents(__DIR__ . '/../../jsons/' . $fileName . '.json');
        $pageContent = json_decode($jsonFile, JSON_OBJECT_AS_ARRAY);
        return $pageContent;
    }
}
