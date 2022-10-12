<?php
include __DIR__ . '/../Model/Category.php';
class CategoryController extends Category {
    public function getMenuDataFromModel($file_Name){
        return Category::getCategorysFromJson($file_Name);
    }
}
