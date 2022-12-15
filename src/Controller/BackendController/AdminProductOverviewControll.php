<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepositoryInterface;

class AdminProductOverviewControll implements ControllerInterface
{
    public function __construct(
        private readonly ViewInterface $view,
        private readonly ProductRepositoryInterface $products
    ) {
    }

    public function renderView(): void
    {
        if (isset($_POST['submit'])) {
            $productId = (int)$_GET['productId'];
            $this->products->deleteProductById($productId);
        }
        $mainId = (int)$_GET['mainId'];
        $products = $this->products->getProductByMainId($mainId);
        $productsArray = [];
        foreach ($products as $row) {
            $productsArray[$row->productId] = $row->displayName;
        }
        $_SESSION['mainId'] = $mainId;
        $this->view->addTemplateParameter('products', $productsArray);
        $this->view->setTemplate('productOverviewAdmin.tpl');
    }
}