<?php
include __DIR__ . '/../Model/Products.php';

class ProductsController{

    public function getContentFromModel($fileName){
        return (new Products()) -> getProductsFromJson($fileName);
    }

}
?>