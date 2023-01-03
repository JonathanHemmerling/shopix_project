<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepositoryInterface;


class UserProductSingleRecordControll implements ControllerInterface
{
    public function __construct(
        private readonly ViewInterface $view,
        private readonly ProductRepositoryInterface $productRepository
    ) {
    }

    public function renderView(): void
    {
        $productId = (int)$_GET['productId'];
        $singleProduct = $this->productRepository->getProductByProductId($productId);
        $strForProductName[] = $singleProduct->displayName . ':';
        $strForProductDescription[] = $singleProduct->description;
        $strForPrice[] = $singleProduct->price;
        $this->view->addTemplateParameter('productName', $strForProductName);
        $this->view->addTemplateParameter('productDescription', $strForProductDescription);
        $this->view->addTemplateParameter('price', $strForPrice);
        $this->view->setTemplate('productSingleRecord.tpl');
    }
}