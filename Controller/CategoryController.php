<?php
namespace Controller;
include __DIR__ . '/../Model/Category.php';
Use Model as mod;

class CategoryController {

    public function getMenuDataFromModel($fileName){
        return (new Mod\Category()) -> getCategorysFromJson($fileName);
    }

}
