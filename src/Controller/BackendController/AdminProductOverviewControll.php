<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepositoryInterface;

class AdminProductOverviewControll implements ControllerInterface
{

    public function __construct(private readonly ViewInterface $view, private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function renderView(): void
    {
        $mainId = (int)$_GET['mainId'];
        $productId = (int)$_GET['productId'];
        $_SESSION['mainId'] = $mainId;

        if (isset($_POST['submit'])) {
            $this->productRepository->deleteProductById($productId);
        }
        $productsFromRepository = $this->productRepository->getProductByMainId($mainId);
        if(!isset($productsFromRepository)){
            $productsFromRepository = [];
        }
        $productDataSet = [];
        foreach ($productsFromRepository as $row) {
            $productDataSet[$row->productId] = $row->displayName;
        }
        $this->view->addTemplateParameter('productDataSet', $productDataSet);
        $this->view->setTemplate('productOverviewAdmin.tpl');
    }
}