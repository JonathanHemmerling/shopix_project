<?php
namespace Controller;
include __DIR__ . '/../Model/Products.php';
Use Model as Mod;
class ProductsController{

    public function getContentFromModel($fileName){
        return (new Mod\Products())-> getProductsFromJson($fileName);
    }

}
?>