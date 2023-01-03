<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepository;

class AdminProductSingleRecordControll implements ControllerInterface
{
    public function __construct(private readonly ViewInterface $view, private readonly ProductRepository $productRepository)
    {
    }

    public function renderView(): void
    {
        $productIdBeforeSubmit = (int)$_GET['productId'];
        if (isset($_POST['submit'])) {
            $productDataSubmitted = $_POST;
            $productData = $this->productRepository->getProductByProductId($productIdBeforeSubmit);
            $productIdAfterSubmit = $productData->productId;
            $this->productRepository->editProductById($productIdAfterSubmit, 'displayName', $productDataSubmitted['displayName']);
            $this->productRepository->editProductById($productIdAfterSubmit, 'description', $productDataSubmitted['productDescription']);
            $this->productRepository->editProductByid($productIdAfterSubmit, 'price', $productDataSubmitted['price']);
        }

        $productDataSet = [];
        $productFromRepository = $this->productRepository->getProductByProductId($productIdBeforeSubmit);
        $productDataSet['displayName'] = $productFromRepository->displayName;
        $productDataSet['productDescription'] = $productFromRepository->description;
        $productDataSet['price'] = $productFromRepository->price;
        $_SESSION['productId'] = $productFromRepository->productId;
        $this->view->addTemplateParameter('productDataSet', $productDataSet);
        $this->view->setTemplate('productSingleRecordAdmin.tpl');
    }
}