<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepository;

class DetailDataControll  implements ControllerInterface
{


    public function __construct(private ViewInterface $view, private ProductRepository $products)
    {
    }

    public function renderView(): void
    {
        if (isset($_POST['submit'])) {
            $productDataFromForm = $_POST;
            $productName = $_GET['productName'];
            $productData = $this->products->getProductByProductNameFromDatabase($productName);
            $productId = $productData->productId;
            $this->products->editProductByName($productId, 'displayName', $productDataFromForm['displayName']);
            $this->products->editProductByName($productId, 'description', $productDataFromForm['productDescription']);
            $this->products->editProductByName($productId, 'price', $productDataFromForm['price']);
            $_GET['productName'] = $productDataFromForm['displayName'];
            unset($_POST);
        }
        $productName = $_GET['productName'];
        $arrayMain = [];
        $mainCategorys = $this->products->getProductByProductNameFromDatabase($productName);
        $arrayMain['displayName'] = $mainCategorys->displayName;
        $arrayMain['productDescription'] = $mainCategorys->description;
        $arrayMain['price'] = $mainCategorys->price;
        $idArray['name'] = $mainCategorys->displayName;
        $this->view->addTemplateParameter('productName', $arrayMain);
        $this->view->addTemplateParameter('productId', $idArray);

        $this->view->setTemplate('productDetail.tpl');
    }
}