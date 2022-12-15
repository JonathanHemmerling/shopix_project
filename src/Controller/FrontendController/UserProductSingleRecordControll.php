<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepositoryInterface;


class UserProductSingleRecordControll implements ControllerInterface
{

    private array $strForProductName;
    private array $strForProductDescription;
    private array $strForPrice;

    public function __construct(
        private readonly ViewInterface $view,
        private readonly ProductRepositoryInterface $products
    ) {
    }

    public function renderView(): void
    {
        $productId = (int)$_GET['productId'];
        $singleProduct = $this->products->getProductByProductId($productId);
        $this->strForProductName[] = $singleProduct->displayName . ':';
        $this->strForProductDescription[] = $singleProduct->description;
        $this->strForPrice[] = $singleProduct->price;
        $this->view->addTemplateParameter('productName', $this->strForProductName);
        $this->view->addTemplateParameter('productDescription', $this->strForProductDescription);
        $this->view->addTemplateParameter('price', $this->strForPrice);
        $this->view->setTemplate('productSingleRecord.tpl');
    }
}