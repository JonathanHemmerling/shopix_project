<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

use App\Core\ViewInterface;
use App\Model\ProductRepositoryInterface;


class DetailControll implements DetailControllInterface
{

    private array $strForProductName;
    private array $strForProductDescription;
    private array $strForPrice;
    private const HomeLink = ['<a href="index.php">Home</a>'];
    private const changeUserData = ['<a href="index.php?pageb=ChangeUserData">Change Userdata</a>'];

    public function __construct(
        private ViewInterface $view,
        private ProductRepositoryInterface $products
    ) {
    }

    public function setStrForProductName(array $strForProductName): void
    {
        $this->strForProductName = $strForProductName;
    }

    public function getStrForProductName(): array
    {
        return $this->strForProductName;
    }

    public function setStrForProductDescription(array $strForProductDescription): void
    {
        $this->strForProductDescription = $strForProductDescription;
    }

    public function getStrForProductDescription(): array
    {
        return $this->strForProductDescription;
    }

    public function setStrForPrice(array $strForPrice): void
    {
        $this->strForPrice = $strForPrice;
    }

    public function getStrForPrice(): array
    {
        return $this->strForPrice;
    }

    private function addProductParameterToProductArray(): void
    {
        $pageId = (int)$_GET['subId'];
        $singleProduct = $this->products->getAllDataFromProducts($pageId);
        $this->setStrForProductName([$singleProduct->displayName . ':']);
        $this->setStrForProductDescription([$singleProduct->productDescription]);
        $this->setStrForPrice([$singleProduct->price]);
    }

    private function addParameterToView(): void
    {
        $this->addProductParameterToProductArray();
        $this->view->addTemplateParameter('productHome', self::HomeLink);
        $this->view->addTemplateParameter('productName', $this->getStrForProductName());
        $this->view->addTemplateParameter('productDescription', $this->getStrForProductDescription());
        $this->view->addTemplateParameter('price', $this->getStrForPrice());
        $this->view->addTemplateParameter('changeUserData', self::changeUserData);
    }

    public function renderView(): void
    {
        $this->addParameterToView();
        $this->view->setTemplate('product.tpl');
    }
}