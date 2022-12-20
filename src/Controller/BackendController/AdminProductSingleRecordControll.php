<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepository;

class AdminProductSingleRecordControll implements ControllerInterface
{
    private int $productId;
    public function __construct(private readonly ViewInterface $view, private readonly ProductRepository $products)
    {
    }

    public function renderView(): void
    {
        $this->productId = (int)$_GET['productId'];
        if (isset($_POST['submit'])) {
            $productDataFromForm = $_POST;
            $productData = $this->products->getProductByProductId($this->productId);
            $productId = $productData->productId;
            $this->products->editProductById($productId, 'displayName', $productDataFromForm['displayName']);
            $this->products->editProductById($productId, 'description', $productDataFromForm['productDescription']);
            $this->products->editProductByid($productId, 'price', $productDataFromForm['price']);
        }

        $arrayMain = [];
        $mainCategorys = $this->products->getProductByProductId($this->productId);
        $arrayMain['displayName'] = $mainCategorys->displayName;
        $arrayMain['productDescription'] = $mainCategorys->description;
        $arrayMain['price'] = $mainCategorys->price;
        $_SESSION['productId'] = $mainCategorys->productId;
        $this->view->addTemplateParameter('productName', $arrayMain);
        $this->view->setTemplate('productSingleRecordAdmin.tpl');
    }
}