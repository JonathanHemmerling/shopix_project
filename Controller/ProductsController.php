<?php
include __DIR__ . '/../Model/Products.php';

class ProductsController extends Products {

    public function getContentFromModel($file_Name){
        return Products::getCategorysFromJson($file_Name);
    }

}
?>