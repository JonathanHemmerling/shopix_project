<?php

namespace src\Controller;

use App\Model as mod;

class CategoryController
{

    public function getMenuDataFromModel($fileName)
    {
        return (new Mod\Category())->getCategorysFromJson($fileName);
    }

}