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
        private readonly ProductRepository $productRepository,
    ) {

    }

    public function renderView(): void
    {
        $mainId = (int)$_GET['mainId'];
        if (isset($_POST['submit'])) {
            $productDataSbmitted = $_POST;
            $this->productRepository->createNewProduct(
                $mainId,
                $productDataSbmitted['displayName'],
                $productDataSbmitted['productName'],
                $productDataSbmitted['description'],
                $productDataSbmitted['price']
            );
        }
        $this->view->addTemplateParameter('mainId', [$mainId]);
        $this->view->setTemplate('createProduct.tpl');
    }
}