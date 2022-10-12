<?php
include __DIR__ . '/../Model/Category.php';
class CategoryController {
    public function getMenuDataFromModel($fileName){
        return (new Category()) -> getCategorysFromJson($fileName);
    }
}
