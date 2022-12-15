<?php

declare(strict_types=1);

namespace App\Controller\BackendController;


use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepository;

class CreateProductControll implements ControllerInterface
{

    public function __construct(
        private readonly ViewInterface $view,
        private readonly ProductRepository $products,
    ) {
    }

    public function renderView(): void
    {
        $mainId = $_GET['mainId'];
        if (isset($_POST['submit'])) {
            $productDataFromForm = $_POST;
            $this->products->createNewProduct(
                (int)$mainId,
                $productDataFromForm['displayName'],
                $productDataFromForm['productName'],
                $productDataFromForm['description'],
                $productDataFromForm['price']
            );
        }
        $this->view->addTemplateParameter('mainId', [$mainId]);
        $this->view->setTemplate('createProduct.tpl');
    }
}