<?php

namespace src\Controller;

use App\Model as Mod;

class ProductsController
{

    public function getContentFromModel($fileName)
    {
        return (new Mod\Products())->getProductsFromJson($fileName);
    }

}

?>