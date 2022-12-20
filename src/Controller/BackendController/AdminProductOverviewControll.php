<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepositoryInterface;

class AdminProductOverviewControll implements ControllerInterface
{
    private int $mainId;
    private int $productId;

    public function __construct(private readonly ViewInterface $view, private readonly ProductRepositoryInterface $products)
    {

    }

    public function renderView(): void
    {
        $this->mainId = (int)$_GET['mainId'];
        $this->productId = (int)$_GET['productId'];
        $_SESSION['mainId'] = $this->mainId;

        if (isset($_POST['submit'])) {
            $this->products->deleteProductById($this->productId);
        }

        $products = $this->products->getProductByMainId($this->mainId);
        $productsArray = [];
        foreach ($products as $row) {
            $productsArray[$row->productId] = $row->displayName;
        }
        $this->view->addTemplateParameter('products', $productsArray);
        $this->view->setTemplate('productOverviewAdmin.tpl');
    }
}