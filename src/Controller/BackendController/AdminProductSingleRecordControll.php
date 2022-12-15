<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepository;

class AdminProductSingleRecordControll implements ControllerInterface
{
    public function __construct(private readonly ViewInterface $view, private readonly ProductRepository $products)
    {
    }

    public function renderView(): void
    {
        if (isset($_POST['submit'])) {
            $productDataFromForm = $_POST;
            $productId = (int)$_GET['productId'];
            $productData = $this->products->getProductByProductId($productId);
            $productId = $productData->productId;
            $this->products->editProductById($productId, 'displayName', $productDataFromForm['displayName']);
            $this->products->editProductById($productId, 'description', $productDataFromForm['productDescription']);
            $this->products->editProductByid($productId, 'price', $productDataFromForm['price']);
        }
        $productId = (int)$_GET['productId'];
        $arrayMain = [];
        $mainCategorys = $this->products->getProductByProductId($productId);
        $arrayMain['displayName'] = $mainCategorys->displayName;
        $arrayMain['productDescription'] = $mainCategorys->description;
        $arrayMain['price'] = $mainCategorys->price;
        $_SESSION['productId'] = $mainCategorys->productId;
        $this->view->addTemplateParameter('productName', $arrayMain);
        $this->view->setTemplate('productSingleRecordAdmin.tpl');
    }
}